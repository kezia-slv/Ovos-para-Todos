<?php

namespace Ovos\Ebenezer\Controllers;

use Ovos\Ebenezer\Core\View;
use Ovos\Ebenezer\Database\Database;
use Ovos\Ebenezer\Models\TipoOvo;
use Ovos\Ebenezer\Models\Produto;
use Ovos\Ebenezer\Controllers\Admin\AuthenticatedController;

class DashboardController extends AuthenticatedController
{
    private $db;
    private $tipoOvoModel;
    private $produtoModel;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getInstance();
        $this->tipoOvoModel = new TipoOvo($this->db);
        $this->produtoModel = new Produto($this->db);
    }

    /**
     * Exibe o painel principal do administrador.
     * Coleta estatisticas de produtos, tipos de ovo, vendas e pedidos.
     */
    public function index()
    {
        // Estatisticas de Tipos de Ovo (equivalente a categorias)
        $totalTipoOvo = (int) ($this->tipoOvoModel->totalDeTipoOvo()[0] ?? 0);
        $totalTipoOvoInativos = (int) ($this->tipoOvoModel->totalDeTipoOvoInativos()[0] ?? 0);

        // Estatisticas de Produtos (equivalente a itens)
        $totalProdutos = (int) $this->produtoModel->totalDeProdutos();
        $totalProdutosInativos = (int) $this->produtoModel->totalDeProdutosInativos();

        // Vendas e faturamento do mes atual
        try {
            $stmtVendas = $this->db->query(
                "SELECT COUNT(*) FROM tbl_vendas
                 WHERE MONTH(criado_em) = MONTH(CURRENT_DATE())
                   AND YEAR(criado_em) = YEAR(CURRENT_DATE())"
            );
            $vendasMes = (int) $stmtVendas->fetchColumn();

            $stmtFaturamento = $this->db->query(
                "SELECT COALESCE(SUM(valor_total), 0) FROM tbl_vendas
                 WHERE MONTH(criado_em) = MONTH(CURRENT_DATE())
                   AND YEAR(criado_em) = YEAR(CURRENT_DATE())"
            );
            $faturamentoMes = (float) $stmtFaturamento->fetchColumn();

            // Contagem de pedidos pendentes
            $stmtPendentes = $this->db->query(
                "SELECT COUNT(*) FROM tbl_pedidos
                 WHERE status_pedido = 'Pendente'
                   AND excluido_em IS NULL"
            );
            $totalPendentes = (int) $stmtPendentes->fetchColumn();
        } catch (\Throwable $e) {
            $vendasMes = 0;
            $faturamentoMes = 0.0;
            $totalPendentes = 0;
        }

        // Ultimos 5 produtos cadastrados
        $ultimosProdutos = $this->produtoModel->paginacao(1, 5)['data'];

        // Preparar dados para graficos (ultimos N meses, padrao 6)
        $period = isset($_GET['period']) ? (int) $_GET['period'] : 6;
        $allowed = [3, 6, 12];
        if (!in_array($period, $allowed)) {
            $period = 6;
        }

        $vendas_chart_labels = [];
        $vendas_chart_data = [];
        $pedidos_chart_labels = [];
        $pedidos_chart_data = [];

        try {
            // Vendas agrupadas por mes
            $sqlVendas = "SELECT YEAR(criado_em) as yr, MONTH(criado_em) as m, COUNT(*) as total
                          FROM tbl_vendas
                          WHERE criado_em >= DATE_SUB(CURRENT_DATE(), INTERVAL " . ($period - 1) . " MONTH)
                          GROUP BY yr, m";
            $stmt = $this->db->query($sqlVendas);
            $vendasMap = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $vendasMap[sprintf('%04d-%02d', $row['yr'], $row['m'])] = (int) $row['total'];
            }

            // Pedidos agrupados por mes
            $sqlPedidos = "SELECT YEAR(criado_em) as yr, MONTH(criado_em) as m, COUNT(*) as total
                           FROM tbl_pedidos
                           WHERE criado_em >= DATE_SUB(CURRENT_DATE(), INTERVAL " . ($period - 1) . " MONTH)
                             AND excluido_em IS NULL
                           GROUP BY yr, m";
            $stmt2 = $this->db->query($sqlPedidos);
            $pedidosMap = [];
            while ($row = $stmt2->fetch(\PDO::FETCH_ASSOC)) {
                $pedidosMap[sprintf('%04d-%02d', $row['yr'], $row['m'])] = (int) $row['total'];
            }

            // Meses em portugues abreviados
            $pt_months = [
                '01' => 'Jan', '02' => 'Fev', '03' => 'Mar',
                '04' => 'Abr', '05' => 'Mai', '06' => 'Jun',
                '07' => 'Jul', '08' => 'Ago', '09' => 'Set',
                '10' => 'Out', '11' => 'Nov', '12' => 'Dez'
            ];

            for ($i = $period - 1; $i >= 0; $i--) {
                $time = strtotime("-{$i} months");
                $monthNum = date('m', $time);
                $label = $pt_months[$monthNum] . '/' . date('Y', $time);
                $key = date('Y-m', $time);

                $vendas_chart_labels[] = $label;
                $vendas_chart_data[] = $vendasMap[$key] ?? 0;

                $pedidos_chart_labels[] = $label;
                $pedidos_chart_data[] = $pedidosMap[$key] ?? 0;
            }
        } catch (\Throwable $e) {
            $vendas_chart_labels = [];
            $vendas_chart_data = [];
            $pedidos_chart_labels = [];
            $pedidos_chart_data = [];
        }

        View::render('admin/dashboard/index', [
            'nomeUsuario'           => $this->session->get('usuario_nome') ?? '',
            'Tipo'                  => $this->session->get('usuario_tipo') ?? '',
            'totalTipoOvo'          => $totalTipoOvo,
            'totalTipoOvoInativos'  => $totalTipoOvoInativos,
            'totalProdutos'         => $totalProdutos,
            'totalProdutosInativos' => $totalProdutosInativos,
            'vendasMes'             => $vendasMes,
            'faturamentoMes'        => $faturamentoMes,
            'ultimosProdutos'       => $ultimosProdutos,
            'vendas_chart_labels'   => $vendas_chart_labels,
            'vendas_chart_data'     => $vendas_chart_data,
            'pedidos_chart_labels'  => $pedidos_chart_labels,
            'pedidos_chart_data'    => $pedidos_chart_data,
            'totalPendentes'        => $totalPendentes,
        ]);
    }
}

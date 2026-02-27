</main>
</div><!-- .main-wrapper -->

<script>
    /* ── Auto-dismiss flash messages após 5 s ── */
    document.addEventListener('DOMContentLoaded', function () {
        const flash = document.querySelector('.flash');
        if (flash) {
            setTimeout(() => {
                flash.style.transition = 'opacity .4s ease, transform .4s ease';
                flash.style.opacity    = '0';
                flash.style.transform  = 'translateY(-8px)';
                setTimeout(() => flash.remove(), 420);
            }, 5000);
        }
    });
</script>
</body>
</html>
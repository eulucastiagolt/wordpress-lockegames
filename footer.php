    <section class="dark-section py-6 text-gray-300">
        <div class="container-xl">
            <div class="flex md:justify-between md:items-center flex-col md:flex-row">
                <div class="flex flex-col">
                    <h2 class="text-orange text-sm font-bold uppercase font-poppins">Conecte-se</h2>
                    <h3 class="text-3xl font-bold text-white uppercase font-poppins">Sigam nossos canais</h3>
                </div>

                <div class="flex gap-4">
                    <a href="#" class="w-12 h-12 bg-linear-120 from-pink to-orange text-white shadow-lg shadow-pink/40 hover:transform hover:-translate-y-2 transition-all flex justify-center items-center rounded-full">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-linear-120 from-pink to-orange text-white shadow-lg shadow-pink/40 hover:transform hover:-translate-y-2 transition-all flex justify-center items-center rounded-full">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-linear-120 from-pink to-orange text-white shadow-lg shadow-pink/40 hover:transform hover:-translate-y-2 transition-all flex justify-center items-center rounded-full">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <footer class="site-footer">
        <div class="container-xl">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="footer-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="Locke Games, início">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/logo-locke-games-gradient.svg'); ?>" alt="Locke Games" loading="lazy" decoding="async">
                    </a>
                    <p>Jogos, cultura e tudo que faz a gente apertar start.</p>
                </div>
                <nav class="footer-nav" aria-label="Navegação do rodapé">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'container' => false,
                        'menu_class' => 'footer-menu',
                        'depth' => 1,
                    ));
                    ?>
                </nav>
                <div class="footer-note">
                    <strong>Locke Games</strong>
                    <span>Conteúdo independente para quem ama jogar.</span>
                    <small>&copy; <?php echo esc_html(wp_date('Y')); ?> Locke Games</small>
                </div>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
    </body>
</html>

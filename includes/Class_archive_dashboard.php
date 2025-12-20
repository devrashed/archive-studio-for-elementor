<?php 
/**
 * Dashboard layout
 *
 */ 
Class class_archive_dashboard {
 
    public function __construct() {        
        add_action( 'admin_menu', [$this, 'wpcft_register_archive_dashboard_menu'] );
    }
   
    public function wpcft_register_archive_dashboard_menu() {
        add_menu_page(
            'Archive Studio',
            'Archive Studio',
            'manage_options',
            'archive-studio',
            [ $this, 'wpcft_archive_settings_page' ],
            'dashicons-archive',
            6
        );
    }

    public function wpcft_archive_settings_page() {

        // Save settings
        if ( isset($_POST['layout_submit']) ) {
            if ( isset($_POST['layout_option']) ) {
                update_option('layout_option', sanitize_text_field($_POST['layout_option']));
            }
        }
        $selected = get_option('layout_option', true);
        ?>

        <div class="wrap">
            <h1>Grid Radio Button Settings</h1>

            <form method="post">

                <div class="layout-grid">

                    <label class="layout-card <?php echo ($selected == 'layout_1') ? 'selected' : ''; ?>">
                        <input type="radio" name="layout_option" value="layout_1"
                            <?php checked($selected, 'layout_1'); ?>>
                        <strong>Option One</strong><br>
                        <small>Description for option one</small>
                    </label>

                    <label class="layout-card <?php echo ($selected == 'layout_2') ? 'selected' : ''; ?>">
                        <input type="radio" name="layout_option" value="layout_2"
                            <?php checked($selected, 'layout_2'); ?>>
                        <strong>Option Two</strong><br>
                        <small>Description for option two</small>
                    </label>
                </div>
                <?php submit_button('Save Settings', 'primary', 'layout_submit'); ?>

            </form>

            <script>
                // Add selected class when clicking
                document.querySelectorAll('.layout-card input').forEach(function(el) {
                    el.addEventListener('change', function() {
                        document.querySelectorAll('.layout-card').forEach(c => c.classList.remove('selected'));
                        el.closest('.layout-card').classList.add('selected');
                    });
                });
            </script>
        </div>

       <?php
    }

}

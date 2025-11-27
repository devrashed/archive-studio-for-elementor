<?php 
/**
 * Dashboard layout
 *
 */ 


Class Class_archive_dashboard {
 
    public function __construct() {
        
        add_action( 'admin_menu', [ $this, 'register_archive_dashboard_menu' ] );
    }
   
    public function register_archive_dashboard_menu() {
        add_menu_page(
            'Archive Dashboard',
            'Archive Dashboard',
            'manage_options',
            'archive-dashboard',
            [ $this, 'my_radio_settings_page' ],
            'dashicons-archive',
            6
        );
    }

    public function wpcar_archive_dashboard_page() {
     ?>
            <h1>Archive Dashboard</h1>
        <?php 
        // Save settings
        if ( isset($_POST['my_radio_submit']) ) {
            if ( isset($_POST['my_radio_option']) ) {
                update_option('my_radio_option', sanitize_text_field($_POST['my_radio_option']));
            }
        }

        // Get saved value
        $selected = get_option('my_radio_option');
        ?>
        
        <div class="wrap">
            <h1>Radio Button Settings</h1>

            <form method="post">
                <table class="form-table">
                    <tr>
                        <th>Select Option:</th>
                        <td>
                            <label>
                                <input type="radio" name="my_radio_option" value="option_1"
                                    <?php checked($selected, 'option_1'); ?> />
                                Layout One
                            </label>
                            <br>
                            <label>
                                <input type="radio" name="my_radio_option" value="option_2"
                                    <?php checked($selected, 'option_2'); ?> />
                                Layout Two
                            </label>
                        </td>
                    </tr>
                </table>
                <?php submit_button('Save Settings', 'primary', 'my_radio_submit'); ?>
            </form>
        </div>
        <?php
    }


    public function my_radio_settings_page() {

        // Save settings
        if ( isset($_POST['layout_submit']) ) {
            if ( isset($_POST['layout_option']) ) {
                update_option('layout_option', sanitize_text_field($_POST['layout_option']));
            }
        }
        $selected = get_option('layout_option', true);
        ?>

        <style>
            .layout-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
                max-width: 500px;
                margin-top: 20px;
            }
            .layout-card {
                border: 2px solid #ccc;
                padding: 20px;
                border-radius: 10px;
                cursor: pointer;
                transition: 0.3s;
                background: #fff;
            }
            .layout-card:hover {
                border-color: #0073aa;
            }

            .layout-card input {
                margin-right: 10px;
            }
            /* Highlight selected */
            .layout-card.selected {
                border-color: #0073aa;
                background: #f0f8ff;
            }
            @media (max-width: 600px) {
                .layout-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>

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

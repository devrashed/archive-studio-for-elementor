(function($){
    $(document).ready(function(){
        // Apply column variable for grid/masonry from data attribute
        $('.eaw-archive').each(function(){
            var columns = $(this).data('columns') || 3;
            // set a CSS variable on wrapper for use in CSS
            this.style.setProperty('--eaw-columns', columns);
        });
    });
})(jQuery);



 // Add selected class when clicking
    document.querySelectorAll('.layout-card input').forEach(function(el) {
        el.addEventListener('change', function() {
            document.querySelectorAll('.layout-card').forEach(c => c.classList.remove('selected'));
            el.closest('.layout-card').classList.add('selected');
        });
    });
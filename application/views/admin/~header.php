<link rel="stylesheet" href="<?php echo base_url();?>public/css/admin/main.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/admin/admin.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<script src="<?php echo base_url();?>public/js/jquery-1.8.1.min.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="<?php echo base_url();?>public/js/admin.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/tinymce4.1/tinymce.min.js"></script>
<script type="text/javascript">

    tinymce.init({
        selector: "textarea",
        theme: "modern",
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ]
    });

</script>
<div class="cfl_box">
    <style scoped>
        .cfl_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .cfl_field{
            display: contents;
        }
    </style>
    <p class="meta-options cfl_field">
        <label for="post_custom_external_url">Add Custom Link</label>
        <input id="post_custom_external_url" type="text" name="post_custom_external_url" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'post_custom_external_url', true ) ); ?>">
    </p>
</div>
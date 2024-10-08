<?php

declare (strict_types=1);
/* namespace { PHP-SCOPER: Namespace removed intentionally */
    \defined('ABSPATH') || exit;
    /**
     * @var int $groupId
     * @var array $data
     */
    ['id' => $groupId] = $data;
    $term = \get_term_by('id', $groupId, 'spec-group');
    ?>

<form action="#" method="post" id="dwps_modify_form">
    <p>
        <label for="group_name"><?php 
    echo \esc_html__('Group name : ', 'product-specifications');
    ?></label>
        <input name="group_name" value="<?php 
    echo \esc_attr($term->name);
    ?>" id="group_name" aria-required="true" type="text">
    </p>

    <p>
        <label for="group_slug"><?php 
    echo \esc_html__('Group slug : ', 'product-specifications');
    ?></label>
        <input name="group_slug" value="<?php 
    echo \esc_attr($term->slug);
    ?>" id="group_slug" placeholder="<?php 
    echo \esc_attr__('Optional', 'product-specifications');
    ?>" type="text">
    </p>

    <p>
        <label for="group_desc"><?php 
    echo \esc_html__('Description : ', 'product-specifications');
    ?></label>
        <textarea name="group_desc" id="group_desc" placeholder="<?php 
    echo \esc_attr__('Optional', 'product-specifications');
    ?>"><?php 
    echo \esc_html($term->description);
    ?></textarea>
    </p>

    <input name="action" value="dwps_modify_groups" type="hidden">
    <input name="do" value="edit" type="hidden">
    <input name="group_id" value="<?php 
    echo \esc_attr($groupId);
    ?>" type="hidden">

    <?php 
    \wp_nonce_field('dwps_modify_groups', 'dwps_modify_groups_nonce');
    ?>
    <input value="<?php 
    echo \esc_attr__('Update Group', 'product-specifications');
    ?>" class="button button-primary" type="submit">
</form>
<?php 
/* } PHP-SCOPER: Namespace removed intentionally */
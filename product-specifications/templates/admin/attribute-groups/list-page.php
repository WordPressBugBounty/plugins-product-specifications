<?php

declare (strict_types=1);
/* namespace { PHP-SCOPER: Namespace removed intentionally */
    use Amiut\ProductSpecs\Repository\EntityCollection;
    \defined('ABSPATH') || exit;
    /**
     * @var EntityCollection $collection
     * @var string $searchKeyword
     * @var array $data
     */
    ['collection' => $collection, 'searchKeyword' => $searchKeyword] = $data;
    ?>

<div class="dwps-page">
    <div class="dwps-settings-wrap">
        <h3><?php 
    echo \esc_html__('Attribute Groups', 'product-specifications');
    ?></h3>
        <p class="title-note"></p>

        <div class="dwps-box-wrapper clearfix">
            <div class="dwps-box-top clearfix">
                <h4><?php 
    echo \esc_html__('Attribute Groups', 'product-specifications');
    ?></h4>
                <div class="dwps-group-searchform">
                    <form action="" method="get">
                        <input
                            type="text"
                            name="q"
                            value="<?php 
    echo \esc_attr($searchKeyword);
    ?>"
                            placeholder="<?php 
    echo \esc_attr__('Search...', 'product-specifications');
    ?>"
                        />

                        <input type="hidden" name="page" value="dw-specs-groups" />
                        <button type="submit"><i class="dashicons dashicons-search"></i></button>
                    </form>
                </div><!-- .dwps-group-searchform -->
            </div><!-- .dwps-box-top -->

            <div id="dwps_table_wrap">
                <table class="dwps-table" id="dwps_table">
                    <thead>
                    <tr>
                        <th class="check-column">
                            <input type="checkbox" id="cb-select-all-1" class="selectall" />
                        </th>
                        <th>
                            <?php 
    echo \esc_html__('ID', 'product-specifications');
    ?>
                        </th>
                        <th>
                            <?php 
    echo \esc_html__('Group name', 'product-specifications');
    ?>
                        </th>
                        <th>
                            <?php 
    echo \esc_html__('Group slug', 'product-specifications');
    ?>
                        </th>
                        <th>
                            <?php 
    echo \esc_html__('# of attributes', 'product-specifications');
    ?>
                        </th>
                        <th>
                            <?php 
    echo \esc_html__('Actions', 'product-specifications');
    ?>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php 
    if (\sizeof($collection) > 0) {
        foreach ($collection as $group) {
            $attributes = \dwspecs_get_attributes_by_group($group->term_id);
            ?>
                            <tr>
                                <td class="check-column">
                                    <input
                                        class="dlt-bulk-group" type="checkbox"
                                        name="slct_group[]"
                                        value="<?php 
            echo \esc_attr($group->term_id);
            ?>"
                                    />
                                </td>
                                <td>
                                    <?php 
            echo \esc_html($group->term_id);
            ?>
                                </td>
                                <td>
                                    <h4>
                                        <a
                                            href="#"
                                            class="edit"
                                            aria-label="<?php 
            echo \esc_attr__('Edit group', 'product-specifications');
            ?>"
                                            data-dwpsmodal="true"
                                            data-type="group"
                                            data-action="edit"
                                            data-id="<?php 
            echo \esc_attr($group->term_id);
            ?>"
                                        >
                                            <?php 
            echo \esc_html($group->name);
            ?>
                                        </a>
                                    </h4>
                                </td>
                                <td>
                                    <?php 
            echo \esc_html(\urldecode($group->slug));
            ?>
                                </td>
                                <td>
                                    <?php 
            echo \esc_html(\sizeof($attributes));
            ?>
                                </td>
                                <td class="dwps-actions">
                                    <a
                                        href="#"
                                        class="delete"
                                        data-type="group"
                                        data-id="<?php 
            echo \esc_attr($group->term_id);
            ?>"
                                    >
                                        <i class="dashicons dashicons-no"></i>
                                    </a>
                                    <a
                                        href="#"
                                        role="button"
                                        class="edit"
                                        aria-label="<?php 
            echo \esc_attr__('Edit group', 'product-specifications');
            ?>"
                                        data-dwpsmodal="true"
                                        data-type="group"
                                        data-action="edit"
                                        data-id="<?php 
            echo \esc_attr($group->term_id);
            ?>"
                                    >
                                        <i class="dashicons dashicons-welcome-write-blog"></i>
                                    </a>

                                    <?php 
            echo '<a class="view" href="' . \esc_url(\add_query_arg(['group_id' => $group->term_id, 'page' => 'dw-specs-attrs'], \esc_url(\admin_url('admin.php')))) . '"><i class="dashicons dashicons-visibility"></i></a>';
            ?>

                                    <a href="#" class="re-arange" data-id="<?php 
            echo \esc_attr($group->term_id);
            ?>"><i class="dashicons dashicons-sort"></i></a>
                                </td>
                            </tr>
                            <?php 
        }
    } else {
        echo '<tr><td class="not-found" colspan="5">' . \esc_html__('Nothing found', 'product-specifications') . '</td></tr>';
    }
    ?>
                    </tbody>
                </table>
            </div>
            <!-- #groups_table_wrap -->

            <div class="dwps-buttons clearfix">
                <a
                    id="dpws_bulk_delete_btn"
                    class="dwps-button red-btn delete-selecteds-btn"
                    href="#"
                    role="button"
                    aria-label="<?php 
    echo \esc_attr__('delete Selected attributes', 'product-specifications');
    ?>"
                    disabled
                >
                    <?php 
    echo \esc_html__('Delete Selected', 'product-specifications');
    ?>
                </a>

                <a data-dwpsmodal="true" id="dpws_add_new_btn" class="dwps-button add-new-btn" href="#" role="button" aria-label="<?php 
    echo \esc_attr__('Add a new group', 'product-specifications');
    ?>"><?php 
    echo \esc_html__('Add new', 'product-specifications');
    ?></a>

                <div class="dwps-pagination">
                    <?php 
    echo \paginate_links(['base' => '%_%', 'format' => '?paged=%#%', 'total' => $collection->totalPages(), 'current' => $collection->currentPage(), 'show_all' => \false, 'end_size' => 4, 'mid_size' => 2, 'prev_next' => \true, 'prev_text' => \esc_html__('«', 'product-specifications'), 'next_text' => \esc_html__('»', 'product-specifications'), 'type' => 'plain', 'add_args' => \false, 'add_fragment' => '', 'before_page_number' => '', 'after_page_number' => '']);
    ?>
                </div><!-- .pagination -->
            </div><!-- .dwps-buttons -->

        </div><!-- .dw-box-wrapper -->
    </div><!-- .dw-specs-settings-wrap -->
</div><!-- .dwps-page -->

<script id="dwps_delete_template" type="x-tmpl-mustache" data-templateType="JSON">
    {
        "data" : {
            "type" : "group"
        },
        "modal" : {
            "title" : "<?php 
    echo \esc_html__("Delete Attribute", "product-specifications");
    ?>",
            "content" : "<?php 
    echo \esc_html__("Are you sure you want to delete selected attribute(s)?", "product-specifications");
    ?>",
            "buttons" : {
                "primary": {
                    "value": "<?php 
    echo \esc_html__("Yes", "product-specifications");
    ?>",
                    "href": "#",
                    "className": "modal-btn btn-confirm btn-warn"
                },
                "secondary": {
                    "value": "<?php 
    echo \esc_html__("No", "product-specifications");
    ?>",
                    "className": "modal-btn btn-cancel",
                    "href": "#",
                    "closeOnClick": true
                }
            }
        }
    }
</script>

<script id="dwps_texts_template" type="x-tmpl-mustache">
    {
        "add_btn"     : "<?php 
    echo \esc_attr__('Add', 'product-specifications');
    ?>",
        "edit_btn"    : "<?php 
    echo \esc_attr__('Update', 'product-specifications');
    ?>",
        "add_title"   : "<?php 
    echo \esc_attr__('Add new group', 'product-specifications');
    ?>",
        "edit_title"  : "<?php 
    echo \esc_attr__('Edit group', 'product-specifications');
    ?>",
        "re_arrange"  : "<?php 
    echo \esc_attr__('Re arrange attributes', 'product-specifications');
    ?>"
    }
</script>

<script id="modify_form_template" type="x-tmpl-mustache">
    <form action="#" method="post" id="dwps_modify_form">
        <p>
            <label for="group_name"><?php 
    echo \esc_html__('Group name : ', 'product-specifications');
    ?></label>
            <input type="text" name="group_name" value="" id="group_name" aria-required="true">
        </p>

        <p>
            <label for="group_slug"><?php 
    echo \esc_html__('Group slug : ', 'product-specifications');
    ?></label>
            <input type="text" name="group_slug" value="" id="group_slug" placeholder="<?php 
    echo \esc_attr__('Optional', 'product-specifications');
    ?>">
        </p>

        <p>
            <label for="group_desc"><?php 
    echo \esc_html__('Description : ', 'product-specifications');
    ?></label>
            <textarea name="group_desc" id="group_desc" placeholder="<?php 
    echo \esc_attr__('Optional', 'product-specifications');
    ?>"></textarea>
        </p>

        <input type="hidden" name="action" value="dwps_modify_groups">
        <input type="hidden" name="do" value="add">
    <?php 
    \wp_nonce_field('dwps_modify_groups', 'dwps_modify_groups_nonce');
    ?>
    <input type="submit" value="<?php 
    echo \esc_attr__('Add Group', 'product-specifications');
    ?>" class="button button-primary">
    </form>
</script>
<?php 
/* } PHP-SCOPER: Namespace removed intentionally */
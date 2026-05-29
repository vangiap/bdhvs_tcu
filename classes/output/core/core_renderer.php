<?php
namespace theme_moove\output;

use moodle_url;
use theme_boost\output\core_renderer as boost_renderer;

class core_renderer extends \theme_boost\output\core_renderer {
    public function custom_combined_menu() {
        $menu = [];

        // Thêm menu từ secondarynavigation.
        if ($this->page->has_secondary_navigation()) {
            foreach ($this->page->secondarynav->get_items() as $item) {
                $menu[] = html_writer::link($item->action, $item->text, ['class' => 'nav-link']);
            }
        }

        // Thêm menu từ secondarymoremenu.
        if ($this->page->has_secondary_more_menu()) {
            foreach ($this->page->secondarymoremenu->get_items() as $item) {
                $menu[] = html_writer::link($item->action, $item->text, ['class' => 'nav-link']);
            }
        }

        // Thêm menu khác nếu cần (ví dụ: My courses)
        if ($this->page->navigation->has_items()) {
            foreach ($this->page->navigation->children as $item) {
                $menu[] = html_writer::link($item->action, $item->text, ['class' => 'nav-link']);
            }
        }

        return implode(' | ', $menu); // Tùy CSS để hiển thị dạng menu
    }
}

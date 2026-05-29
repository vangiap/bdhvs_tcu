<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme helper to load a theme configuration.
 *
 * @package    theme_moove
 * @copyright  2022 Willian Mano - http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_moove\util;

use theme_config;

/**
 * Helper to load a theme configuration.
 *
 * @package    theme_moove
 * @copyright  2017 Willian Mano - http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class settings {
    /**
     * @var \stdClass $theme The theme object.
     */
    protected $theme;
    /**
     * @var array $files Theme file settings.
     */
    protected $files = [
        'loginbg',
        'sliderimage1', 'sliderimage2', 'sliderimage3', 'sliderimage4', 'sliderimage5', 'sliderimage6',
        'sliderimage7', 'sliderimage8', 'sliderimage9', 'sliderimage10', 'sliderimage11', 'sliderimage12',
        // 🆕 Box images - tối đa 12 slides x 6 boxes mỗi slide
        'sliderbox1_1_image', 'sliderbox1_2_image', 'sliderbox1_3_image', 'sliderbox1_4_image', 'sliderbox1_5_image', 'sliderbox1_6_image',
        'sliderbox2_1_image', 'sliderbox2_2_image', 'sliderbox2_3_image', 'sliderbox2_4_image', 'sliderbox2_5_image', 'sliderbox2_6_image',
        'sliderbox3_1_image', 'sliderbox3_2_image', 'sliderbox3_3_image', 'sliderbox3_4_image', 'sliderbox3_5_image', 'sliderbox3_6_image',
        'sliderbox4_1_image', 'sliderbox4_2_image', 'sliderbox4_3_image', 'sliderbox4_4_image', 'sliderbox4_5_image', 'sliderbox4_6_image',
        'sliderbox5_1_image', 'sliderbox5_2_image', 'sliderbox5_3_image', 'sliderbox5_4_image', 'sliderbox5_5_image', 'sliderbox5_6_image',
        'sliderbox6_1_image', 'sliderbox6_2_image', 'sliderbox6_3_image', 'sliderbox6_4_image', 'sliderbox6_5_image', 'sliderbox6_6_image',
        'sliderbox7_1_image', 'sliderbox7_2_image', 'sliderbox7_3_image', 'sliderbox7_4_image', 'sliderbox7_5_image', 'sliderbox7_6_image',
        'sliderbox8_1_image', 'sliderbox8_2_image', 'sliderbox8_3_image', 'sliderbox8_4_image', 'sliderbox8_5_image', 'sliderbox8_6_image',
        'sliderbox9_1_image', 'sliderbox9_2_image', 'sliderbox9_3_image', 'sliderbox9_4_image', 'sliderbox9_5_image', 'sliderbox9_6_image',
        'sliderbox10_1_image', 'sliderbox10_2_image', 'sliderbox10_3_image', 'sliderbox10_4_image', 'sliderbox10_5_image', 'sliderbox10_6_image',
        'sliderbox11_1_image', 'sliderbox11_2_image', 'sliderbox11_3_image', 'sliderbox11_4_image', 'sliderbox11_5_image', 'sliderbox11_6_image',
        'sliderbox12_1_image', 'sliderbox12_2_image', 'sliderbox12_3_image', 'sliderbox12_4_image', 'sliderbox12_5_image', 'sliderbox12_6_image',
        // 🆕 Center logo for each slide (slidercenterlogo1 .. slidercenterlogo12)
        'slidercenterlogo1', 'slidercenterlogo2', 'slidercenterlogo3', 'slidercenterlogo4', 'slidercenterlogo5', 'slidercenterlogo6',
        'slidercenterlogo7', 'slidercenterlogo8', 'slidercenterlogo9', 'slidercenterlogo10', 'slidercenterlogo11', 'slidercenterlogo12',
        'marketing1icon', 'marketing2icon', 'marketing3icon', 'marketing4icon',
    ];

    /**
     * Class constructor
     */
    public function __construct() {
        $this->theme = theme_config::load('moove');
    }

    /**
     * Magic method to get theme settings
     *
     * @param string $name
     *
     * @return false|string|null
     */
    public function __get(string $name) {
        if (in_array($name, $this->files)) {
            return $this->theme->setting_file_url($name, $name);
        }

        if (empty($this->theme->settings->$name)) {
            return false;
        }

        return $this->theme->settings->$name;
    }

    /**
     * Get footer settings
     *
     * @return array
     */
    public function footer() {
        global $CFG;

        $templatecontext = [];

        $settings = [
            'facebook', 'twitter', 'linkedin', 'youtube', 'instagram', 'whatsapp', 'telegram',
            'website', 'mobile', 'mail',
        ];

        foreach ($settings as $setting) {
            $templatecontext[$setting] = $this->$setting;
        }

        $templatecontext['enablemobilewebservice'] = $CFG->enablemobilewebservice;

        if ($CFG->enablemobilewebservice) {
            $iosappid = get_config('tool_mobile', 'iosappid');
            if (!empty($iosappid)) {
                $templatecontext['iosappid'] = $iosappid;
            }

            $androidappid = get_config('tool_mobile', 'androidappid');
            if (!empty($androidappid)) {
                $templatecontext['androidappid'] = $androidappid;
            }

            $setuplink = get_config('tool_mobile', 'setuplink');
            if (!empty($setuplink)) {
                $templatecontext['mobilesetuplink'] = $setuplink;
            }
        }

        return $templatecontext;
    }

    /**
     * Get frontpage settings
     *
     * @return array
     */
    public function frontpage() {
        return array_merge(
            $this->frontpage_slideshow(),
            $this->frontpage_marketingboxes(),
            $this->frontpage_numbers(),
            $this->faq()
        );
    }

    /**
     * Get config theme slideshow
     *
     * @return array
     */
    public function frontpage_slideshow() {
        $templatecontext['slidercount'] = $this->slidercount;

        $defaultimage = new \moodle_url('/theme/moove/pix/default_slide.jpg');
        for ($i = 1, $j = 0; $i <= $templatecontext['slidercount']; $i++, $j++) {
            $sliderimage = "sliderimage{$i}";
            $slidertitle = "slidertitle{$i}";
            $slidesubtitle = "slidesubtitle{$i}";      // 🆕 Phụ đề slide
            $slidercap = "slidercap{$i}";
            $sliderboxes = "sliderboxes{$i}";           // 🆕 Dữ liệu boxes (JSON)
            $slidercapcontent = $this->$slidercap ?: null;

            $slidetitle = format_string($this->$slidertitle) ?: null;
            $slidesubtitlecontent = format_string($this->$slidesubtitle) ?: null;  // 🆕 Format phụ đề
            $slidecontent = format_text($slidercapcontent, FORMAT_MOODLE, ['noclean' => false]) ?: null;
            $image = $this->$sliderimage;

            $hascaption = isset($slidetitle) || isset($slidecontent);

            $templatecontext['slides'][$j]['key'] = $j;
            $templatecontext['slides'][$j]['active'] = $i === 1;
            $templatecontext['slides'][$j]['image'] = $image ?: $defaultimage->out();
            $templatecontext['slides'][$j]['title'] = $slidetitle;
            $templatecontext['slides'][$j]['subtitle'] = $slidesubtitlecontent;  // 🆕 Thêm phụ đề
            // 🆕 Center logo for this slide (file URL if uploaded)
            $centerlogofield = "slidercenterlogo{$i}";
            $centerlogo = $this->$centerlogofield;
            $templatecontext['slides'][$j]['centerlogo'] = $centerlogo ?: null;
            $templatecontext['slides'][$j]['caption'] = $slidecontent;
            $templatecontext['slides'][$j]['hascaption'] = $hascaption;
            
            // 🆕 Xây dựng dữ liệu boxes từ các fields riêng lẻ
            $sliderboxcount = $this->{"sliderboxcount{$i}"};
            if (!empty($sliderboxcount) && $sliderboxcount > 0) {
                $boxes = [];
                for ($boxindex = 1; $boxindex <= $sliderboxcount; $boxindex++) {
                    $boximagefield = "sliderbox{$i}_{$boxindex}_image";
                    $boxtitlefield = "sliderboxtitle{$i}_{$boxindex}";
                    $boxbtnfield = "sliderboxbtn{$i}_{$boxindex}";
                    $boxlinkfield = "sliderboxlink{$i}_{$boxindex}";

                    $boximage = $this->$boximagefield;
                    $boxtitle = format_string($this->$boxtitlefield) ?: null;
                    $buttontext = format_string($this->$boxbtnfield) ?: null;
                    $buttonlink = $this->$boxlinkfield ?: '#';

                    // Chỉ thêm box nếu có tiêu đề hoặc hình ảnh
                    if (!empty($boxtitle) || !empty($boximage)) {
                        $boxes[] = [
                            'boximage' => $boximage ?: null,
                            'boxtitle' => $boxtitle,
                            'buttontext' => $buttontext,
                            'buttonlink' => $buttonlink
                        ];
                    }
                }

                if (!empty($boxes)) {
                    $templatecontext['slides'][$j]['boxes'] = $boxes;
                    $templatecontext['slides'][$j]['hasboxes'] = true;
                    // 🆕 Provide box count and a convenience flag when exactly two boxes
                    $templatecontext['slides'][$j]['boxcount'] = count($boxes);
                    $templatecontext['slides'][$j]['twoboxes'] = (count($boxes) === 2);
                } else {
                    $templatecontext['slides'][$j]['hasboxes'] = false;
                }
            } else {
                $templatecontext['slides'][$j]['hasboxes'] = false;
            }
        }

        $templatecontext['slidersingleslide'] = $this->slidercount == 1;

        return $templatecontext;
    }

    /**
     * Get config theme slideshow
     *
     * @return array
     */
    public function frontpage_marketingboxes() {
        if ($templatecontext['displaymarketingbox'] = $this->displaymarketingbox) {
            $templatecontext['marketingheading'] = format_text($this->marketingheading, FORMAT_HTML);
            $templatecontext['marketingcontent'] = format_text($this->marketingcontent, FORMAT_HTML);

            $defaultimage = new \moodle_url('/theme/moove/pix/default_markegingicon.svg');

            for ($i = 1, $j = 0; $i < 5; $i++, $j++) {
                $marketingicon = 'marketing' . $i . 'icon';
                $marketingheading = 'marketing' . $i . 'heading';
                $marketingcontent = 'marketing' . $i . 'content';

                $templatecontext['marketingboxes'][$j]['icon'] = $this->$marketingicon ?: $defaultimage->out();
                $templatecontext['marketingboxes'][$j]['heading'] = $this->$marketingheading ?
                    format_text($this->$marketingheading, FORMAT_HTML) : 'Lorem';
                $templatecontext['marketingboxes'][$j]['content'] = $this->$marketingcontent ?
                    format_text($this->$marketingcontent, FORMAT_HTML) :
                    'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.';
            }
        }

        return $templatecontext;
    }

    /**
     * Get config theme slideshow
     *
     * @return array
     */
    public function frontpage_numbers() {
        global $DB;

        if ($templatecontext['numbersfrontpage'] = $this->numbersfrontpage) {
            $templatecontext['numberscontent'] = $this->numbersfrontpagecontent ? format_text($this->numbersfrontpagecontent) : '';
            $templatecontext['numbersusers'] = $DB->count_records('user', ['deleted' => 0, 'suspended' => 0]) - 1;
            $templatecontext['numberscourses'] = $DB->count_records('course', ['visible' => 1]) - 1;
        }

        return $templatecontext;
    }

    /**
     * Get config theme slideshow
     *
     * @return array
     */
    public function faq() {
        $templatecontext['faqenabled'] = false;

        if ($this->faqcount) {
            for ($i = 1; $i <= $this->faqcount; $i++) {
                $faqquestion = 'faqquestion' . $i;
                $faqanswer = 'faqanswer' . $i;

                if (!$this->$faqquestion || !$this->$faqanswer) {
                    continue;
                }

                $templatecontext['faq'][] = [
                    'id' => $i,
                    'question' => format_text($this->$faqquestion),
                    'answer' => format_text($this->$faqanswer),
                    'active' => $i === 1,
                ];
            }

            if (!empty($templatecontext['faq'])) {
                $templatecontext['faqenabled'] = true;
            }
        }

        return $templatecontext;
    }
}

# 📘 Hướng Dẫn Tùy Chỉnh Slide - Moove Theme

## 📝 Giới Thiệu
Tài liệu này hướng dẫn cách bổ sung **Text, Hình ảnh, Khối** trên slide frontpage.

---

## 🎨 Cấu Trúc Slide Mới

Slide giờ đây hỗ trợ cấu trúc hoàn chỉnh với:

```
Slide
├── Hình nền (image)
└── Caption Container
    ├── 📌 Tiêu đề chính (slide-title) - VÀ VÀNG, FONT LỚN
    ├── 📝 Phụ đề (slide-subtitle) - TRẮNG, FONT NHỎ
    ├── 📦 Containers Boxes
    │   ├── Box 1
    │   │   ├── Hình ảnh (box-image)
    │   │   ├── Tiêu đề (box-title)
    │   │   └── Nút bấm (btn-slide-action)
    │   ├── Box 2
    │   └── Box 3
    └── 📄 Mô tả chi tiết (caption) - HỖ TRỢ HTML

```

---

## 🔧 Cách Sử Dụng

### **Bước 1: Thêm cấu hình trong `settings.php`**

File: `settings.php` 

Tìm phần `slidercount` và thêm các setting mới:

```php
// Ở phần định nghĩa settings
$settings->add(new admin_setting_configtext(
    'theme_moove/slidercount',
    get_string('slidercount', 'theme_moove'),
    get_string('slidercountdesc', 'theme_moove'),
    3
));

// Cho mỗi slide (lặp lại từ 1 đến slidercount)
// TIÊU ĐỀ CHÍNH
$settings->add(new admin_setting_configtext(
    'theme_moove/slidertitle1',
    'Slide Title 1 (Main)',
    'Tiêu đề chính slide (Màu vàng, font lớn)',
    'BÌNH DÂN HỌC VỤ SỐ 2026'
));

// PHỤ ĐỀ
$settings->add(new admin_setting_configtext(
    'theme_moove/slidesubtitle1',
    'Slide Subtitle 1',
    'Phụ đề slide (Màu trắng, font nhỏ hơn)',
    'Thị đưa đôi mới sáng tạo và chuyển đổi số'
));

// HÌN HẬU NHẬN (Caption - HTML)
$settings->add(new admin_setting_configtextarea(
    'theme_moove/slidercap1',
    'Slide Caption 1',
    'Mô tả chi tiết slide (Hỗ trợ HTML)',
    ''
));

// BOXES DATA (JSON)
$settings->add(new admin_setting_configtextarea(
    'theme_moove/sliderboxes1',
    'Slide Boxes 1 (JSON)',
    'Thêm các khối boxes (JSON format). Ví dụ bên dưới:',
    '[]'
));
```

### **Bước 2: Format dữ liệu Boxes (JSON)**

Mỗi slide có thể có nhiều boxes. Dữ liệu được lưu dưới dạng **JSON**:

```json
[
  {
    "boximage": "https://example.com/image1.jpg",
    "boxtitle": "Kỹ năng số cơ bản",
    "buttontext": "VÀO HỌC NGAY",
    "buttonlink": "https://example.com/course1"
  },
  {
    "boximage": "https://example.com/image2.jpg",
    "boxtitle": "Kỹ năng số nâng cao",
    "buttontext": "VÀO HỌC NGAY",
    "buttonlink": "https://example.com/course2"
  }
]
```

**Các trường dữ liệu:**
- `boximage`: URL của hình ảnh box
- `boxtitle`: Tiêu đề của box
- `buttontext`: Text hiển thị trên nút bấm
- `buttonlink`: Link khi nhấn nút

---

## 🎯 Ví Dụ Hoàn Chỉnh

### **Từng phần của slide:**

#### **1. Hình nền** 
```html
<!-- Được xử lý tự động từ sliderimage1, sliderimage2, v.v... -->
<img src="{{image}}" alt="{{slidertitle}}" class="d-block w-100">
```

#### **2. Tiêu đề chính** (CSS Class: `slide-title`)
```html
<h1 class="slide-title">{{.}}</h1>
```
**CSS:**
- Màu: `#ffeb00` (Vàng)
- Font size: `2.5rem`
- Font weight: `700` (Bold)
- Text shadow: Có bóng đen

#### **3. Phụ đề** (CSS Class: `slide-subtitle`)
```html
<p class="slide-subtitle">{{.}}</p>
```
**CSS:**
- Màu: `#ffffff` (Trắng)
- Font size: `1.3rem`
- Font weight: `600` (Semi-bold)

#### **4. Khối Boxes** (CSS Classes: `.slide-boxes-container`, `.slide-box`)
```html
<div class="slide-boxes-container">
  <div class="slide-box">
    <img src="..." class="box-image">
    <h3 class="box-title">Tiêu đề</h3>
    <a href="#" class="btn-slide-action">VÀO HỌC NGAY</a>
  </div>
</div>
```

**CSS cho Box:**
- Background: Trắng (rgba 95%)
- Border: Vàng (`#ffeb00`) - 3px
- Border radius: `15px`
- Padding: `1rem`
- Hover effect: Nâng cao (+5px), shadow tăng

**CSS cho Nút Bấm:**
- Background: Đỏ (`#ff0000`)
- Color: Trắng
- Border: Đỏ 2px
- Border radius: `25px` (Pill shape)
- Hover: Background trắng, text đỏ

---

## 📂 Các File Đã Sửa

### **1. [templates/frontpage.mustache](templates/frontpage.mustache)**
- ✅ Thêm HTML cho `.slide-title` (tiêu đề)
- ✅ Thêm HTML cho `.slide-subtitle` (phụ đề)
- ✅ Thêm HTML cho `.slide-boxes-container` (container boxes)
- ✅ Thêm HTML cho từng `.slide-box` (khối riêng lẻ)
- ✅ Thêm HTML cho `.box-image` (hình ảnh box)
- ✅ Thêm HTML cho `.box-title` (tiêu đề box)
- ✅ Thêm HTML cho `.btn-slide-action` (nút bấm)

### **2. [scss/moove/_frontpage.scss](scss/moove/_frontpage.scss)**
- ✅ CSS cho `.slide-title` - Vàng, font lớn, text-shadow
- ✅ CSS cho `.slide-subtitle` - Trắng, font cỡp vừa
- ✅ CSS cho `.slide-boxes-container` - Flexbox layout
- ✅ CSS cho `.slide-box` - White bg, yellow border, hover effect
- ✅ CSS cho `.box-image` - Responsive, object-fit
- ✅ CSS cho `.box-title` - Blue color
- ✅ CSS cho `.btn-slide-action` - Red button, hover effect

---

## 🚀 Cách Triển Khai

1. **Backup** cấu hình hiện tại:
   ```bash
   cp settings.php settings.php.backup
   ```

2. **Cập nhật** `classes/util/settings.php` để xử lý dữ liệu JSON boxes:
   ```php
   // Thêm vào hàm frontpage_slideshow()
   $templatecontext['slides'][$j]['subtitle'] = $this->{"slidesubtitle{$i}"};
   
   // Parse JSON boxes
   $boxesdata = $this->{"sliderboxes{$i}"};
   if (!empty($boxesdata)) {
       $templatecontext['slides'][$j]['boxes'] = json_decode($boxesdata, true);
       $templatecontext['slides'][$j]['hasboxes'] = true;
   }
   ```

3. **Truy cập** Moodle Admin > Site Administration > Appearance > Themes > Settings > Moove

4. **Cấu hình** slide:
   - Đặt số lượng slide
   - Thêm hình nền (sliderimage)
   - Nhập tiêu đề (slidertitle)
   - Nhập phụ đề (slidesubtitle) - **MỚI**
   - Nhập JSON boxes (sliderboxes) - **MỚI**

---

## 💡 Mẹo & Tricks

### **Chỉnh sửa CSS nhanh:**
Sửa trực tiếp trong `_frontpage.scss` tại các class:
- `.slide-title` - Đổi màu, font size
- `.slide-box` - Đổi border, shadow
- `.btn-slide-action` - Đổi màu nút

### **Thêm hover animation:**
```scss
.slide-box {
  transition: all 0.3s ease;
  
  &:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
  }
}
```

### **Đổi màu động:**
Sửa trong `_variables.scss`:
```scss
// Màu chủ đề
$brand-primary: #ffeb00; // Vàng
$brand-danger: #ff0000;  // Đỏ
```

---

## 📞 Ghi Chú

- CSS đã có chú thích rõ ràng (`/* ========== ... ========== */`)
- Hỗ trợ Responsive (Mobile, Tablet, Desktop)
- Bootstrap 5 classes được sử dụng
- Format text hỗ trợ Moodle HTML

---

**🎉 Xong! Giờ bạn có thể tùy chỉnh slide một cách dễ dàng.**

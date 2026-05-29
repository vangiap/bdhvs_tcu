# 📋 Changelog - Các Bổ Sung Mới (Ngày 26/5/2026)

## 🎯 3 Yêu Cầu Chính Đã Hoàn Thành

### ✅ **Ý 1: Tách JSON Boxes Thành Input Fields Riêng Lẻ**

**Vấn đề cũ:** 
- Nhập JSON phức tạp vào 1 field `sliderboxes1`
- Khó chỉnh sửa, dễ lỗi syntax

**Giải pháp mới:**
- Thay vì JSON, tách thành các input fields riêng lẻ
- Admin có thể nhập dữ liệu dễ dàng qua giao diện

**Files sửa:**
1. [settings.php](settings.php)
   - Thêm field `sliderboxcount{$i}` - Chọn số lượng boxes
   - Thêm loop để tạo fields cho từng box:
     - `sliderbox{$i}_{$j}_image` - Upload hình ảnh
     - `sliderboxtitle{$i}_{$j}` - Tiêu đề box
     - `sliderboxbtn{$i}_{$j}` - Text nút bấm
     - `sliderboxlink{$i}_{$j}` - Link nút bấm

2. [lang/en/theme_moove.php](lang/en/theme_moove.php)
   - Thêm language strings cho các fields mới:
     - `sliderboxcount` / `sliderboxcountdesc`
     - `sliderboximage` / `sliderboximagedesc`
     - `sliderboxtitle` / `sliderboxdesc`
     - `sliderboxbuttontext` / `sliderboxbuttontextdesc`
     - `sliderboxbuttonlink` / `sliderboxbuttonlinkdesc`

3. [classes/util/settings.php](classes/util/settings.php)
   - Sửa `frontpage_slideshow()` method
   - Xây dựng lại dữ liệu boxes từ các fields riêng lẻ
   - Thay vì JSON decode, lấy trực tiếp từ settings

**Cấu hình trong Admin:**
```
Site Admin > Appearance > Themes > Moove Theme > Frontpage Settings

Slide 1
├── Slider picture: [Upload]
├── Slide title: BÌNH DÂN HỌC VỤ SỐ 2026
├── Slider caption: [HTML Editor]
├── Slide subtitle: Thị đưa đôi mới... 🆕
└── Number of boxes: [0-6] 🆕
    ├── Box 1
    │   ├── Box 1 image: [Upload] 🆕
    │   ├── Box 1 title: Kỹ năng số cơ bản 🆕
    │   ├── Box 1 button text: VÀO HỌC NGAY 🆕
    │   └── Box 1 button link: https://... 🆕
    └── Box 2
        ├── Box 2 image: [Upload]
        ├── Box 2 title: ...
        ├── Box 2 button text: ...
        └── Box 2 button link: ...
```

---

### ✅ **Ý 2: Sửa Carousel-Caption Positioning**

**Vấn đề cũ:**
- Class `d-none d-md-block` ẩn trên mobile
- Caption nằm ở dưới cùng, không tâm giữa slide

**Giải pháp mới:**
- Xóa `d-none d-md-block` để hiển thị trên tất cả devices
- Thêm CSS positioning để caption nằm tâm giữa slide

**Files sửa:**
1. [templates/frontpage.mustache](templates/frontpage.mustache)
   - Xóa class `d-none d-md-block` khỏi `.carousel-caption`
   - Chú thích: `<!-- 🔧 Bỏ d-none d-md-block để hiển thị trên mobile -->`

2. [style/custom.css](style/custom.css)
   - Thêm CSS mới cho `.carousel-caption`:
   ```css
   #page-site-index #mooveslideshow .carousel-caption {
       position: absolute;
       top: 50%;
       transform: translateY(-50%);
       width: 100%;
       left: 0;
       right: 0;
   }
   ```

**Kết quả:**
- Caption hiển thị ở giữa slide (top: 50%, transform: translateY(-50%))
- Hoạt động tốt trên mobile, tablet, desktop

---

### ✅ **Ý 3: Chuyển CSS Sang Custom.CSS**

**Vấn đề cũ:**
- CSS mới cho slide boxes nằm trong `_frontpage.scss`
- SCSS nested khó quản lý
- Khó tìm và chỉnh sửa

**Giải pháp mới:**
- Chuyển ALL CSS mới sang `style/custom.css`
- CSS CSS thường (không SCSS) dễ bảo trì
- Tất cả CSS slide boxes tập trung một chỗ

**Files sửa:**
1. [scss/moove/_frontpage.scss](scss/moove/_frontpage.scss)
   - Xóa toàn bộ CSS cho slide boxes:
     - `.slide-title`
     - `.slide-subtitle`
     - `.slide-boxes-container`
     - `.slide-box`
     - `.box-image-wrapper`
     - `.box-image`
     - `.box-title`
     - `.btn-slide-action`
   - Giữ lại `.carousel-caption` cơ bản

2. [style/custom.css](style/custom.css)
   - Thêm section mới: `🆕 CSS CHO SLIDE BOXES`
   - Tất cả CSS cho slide boxes (khoảng 150 dòng)
   - Bao gồm responsive breakpoints (desktop, tablet, mobile)

**CSS mới được thêm:**
```css
/* ========== 🆕 CSS CHO SLIDE BOXES ========== */

/* Carousel caption positioning */
#page-site-index #mooveslideshow .carousel-caption { ... }

/* Slide title - Yellow, large font */
.slide-title { ... }

/* Slide subtitle - White, medium font */
.slide-subtitle { ... }

/* Container cho boxes - Flexbox layout */
.slide-boxes-container { ... }

/* Từng box - White bg, yellow border, shadow */
.slide-box { ... }

/* Hover effect */
.slide-box:hover { ... }

/* Box image wrapper */
.box-image-wrapper { ... }

/* Box image */
.box-image { ... }

/* Box title */
.box-title { ... }

/* Button styling */
.btn-slide-action { ... }

/* Button hover */
.btn-slide-action:hover { ... }

/* Responsive - Tablet */
@media (max-width: 991px) { ... }

/* Responsive - Mobile */
@media (max-width: 576px) { ... }
```

**Lợi ích:**
- ✅ Dễ tìm kiếm
- ✅ Dễ chỉnh sửa
- ✅ Không bị ảnh hưởng bởi SCSS compilation
- ✅ Admin có thể tùy chỉnh nhanh

---

## 📊 Tóm Tắt Thay Đổi

| Item | File | Sửa/Thêm |
|------|------|---------|
| **Ý 1** | settings.php | Thêm fields input (không JSON) |
|  | lang/en/theme_moove.php | Thêm 8 language strings |
|  | classes/util/settings.php | Sửa logic xây dựng boxes |
| **Ý 2** | templates/frontpage.mustache | Xóa `d-none d-md-block` |
|  | style/custom.css | Thêm positioning CSS |
| **Ý 3** | scss/moove/_frontpage.scss | Xóa 150 dòng CSS mới |
|  | style/custom.css | Thêm 150 dòng CSS mới |

---

## 🚀 Cách Triển Khai

### **Bước 1: Clear Cache**
```
Site Administration > Development > Purge all caches
```

### **Bước 2: Truy cập Admin Settings**
```
Site Administration 
  > Appearance 
    > Themes 
      > Moove Theme
        > Frontpage Settings
```

### **Bước 3: Cấu Hình Slide**
1. Đặt **Number of boxes** = 2 (hoặc số lượng bạn muốn)
2. Nhấn **Save changes**
3. Refresh page - sẽ thấy các fields input cho boxes
4. Điền dữ liệu cho mỗi box

### **Bước 4: Test**
- Truy cập Frontpage để xem slide hiển thị
- Kiểm tra responsive (mobile, tablet, desktop)

---

## 📝 Ghi Chú Quan Trọng

✅ **Fields mới:**
- `sliderboxcount{i}` - Select 0-6 boxes per slide
- `sliderbox{i}_{j}_image` - File upload
- `sliderboxtitle{i}_{j}` - Text input
- `sliderboxbtn{i}_{j}` - Text input
- `sliderboxlink{i}_{j}` - URL input

✅ **CSS dễ tùy chỉnh:**
- Màu vàng: `#ffeb00`
- Màu đỏ nút: `#ff0000`
- Màu xanh tiêu đề: `#0066cc`
- Border-radius box: `15px`

✅ **Responsive:**
- Desktop: 3 boxes per row
- Tablet: 2 boxes per row
- Mobile: 1 box per row

---

## 🔍 Kiểm Tra Quick

**Tất cả 3 yêu cầu đã xong?** ✅
1. Boxes input fields - ✅
2. Carousel-caption positioning - ✅
3. CSS trong custom.css - ✅

**Sẵn sàng deploy!** 🚀

# 📋 Ví Dụ Dữ Liệu Slide & Boxes

## ✅ Cấu Trúc Dữ Liệu Hoàn Chỉnh

### **Moodle Admin Settings:**

Sau khi sửa code, các setting mới sẽ xuất hiện tại:
`Site Administration > Appearance > Themes > Moove Theme`

```
Site admin settings:
├── Slider Count: 2
├── Slide 1
│   ├── sliderimage1: [Upload Image]
│   ├── slidertitle1: "BÌNH DÂN HỌC VỤ SỐ 2026"
│   ├── slidesubtitle1: "Thị đưa đôi mới sáng tạo và chuyển đổi số"
│   ├── slidercap1: "[HTML content]"
│   └── sliderboxes1: "[JSON Array]"
│
└── Slide 2
    ├── sliderimage2: [Upload Image]
    ├── slidertitle2: "...

    ├── slidesubtitle2: "..."
    ├── slidercap2: "[HTML content]"
    └── sliderboxes2: "[JSON Array]"
```

---

## 📦 Ví Dụ JSON Boxes

### **Ví Dụ 1: Slide với 2 boxes**

**Setting: `sliderboxes1`**

Nhập đoạn JSON sau vào field `sliderboxes1`:

```json
[
  {
    "boximage": "https://example.com/images/skill-basic.jpg",
    "boxtitle": "Kỹ năng số cơ bản",
    "buttontext": "VÀO HỌC NGAY",
    "buttonlink": "https://example.com/courses/basic"
  },
  {
    "boximage": "https://example.com/images/skill-advanced.jpg",
    "boxtitle": "Kỹ năng số nâng cao",
    "buttontext": "VÀO HỌC NGAY",
    "buttonlink": "https://example.com/courses/advanced"
  }
]
```

**Kết quả hiển thị:**
```
┌─────────────────────┐  ┌─────────────────────┐
│   [Hình ảnh 1]      │  │   [Hình ảnh 2]      │
│                     │  │                     │
│ Kỹ năng số cơ bản   │  │ Kỹ năng số nâng cao │
│                     │  │                     │
│ [VÀO HỌC NGAY]      │  │ [VÀO HỌC NGAY]      │
└─────────────────────┘  └─────────────────────┘
```

---

### **Ví Dụ 2: Slide với 3 boxes**

**Setting: `sliderboxes1`**

```json
[
  {
    "boximage": "https://example.com/images/box1.jpg",
    "boxtitle": "Khóa 1",
    "buttontext": "ĐĂNG KÝ",
    "buttonlink": "#course1"
  },
  {
    "boximage": "https://example.com/images/box2.jpg",
    "boxtitle": "Khóa 2",
    "buttontext": "ĐĂNG KÝ",
    "buttonlink": "#course2"
  },
  {
    "boximage": "https://example.com/images/box3.jpg",
    "boxtitle": "Khóa 3",
    "buttontext": "ĐĂNG KÝ",
    "buttonlink": "#course3"
  }
]
```

---

### **Ví Dụ 3: Slide không có boxes (rỗng)**

**Setting: `sliderboxes1`**

```json
[]
```

Hoặc để trống, sẽ không hiển thị boxes.

---

### **Ví Dụ 4: Slide với dữ liệu đầy đủ**

**Tất cả settings cho Slide 1:**

| Setting | Giá trị |
|---------|---------|
| `sliderimage1` | `/uploads/banner-2026.jpg` |
| `slidertitle1` | `BÌNH DÂN HỌC VỤ SỐ 2026` |
| `slidesubtitle1` | `Thị đưa đôi mới sáng tạo và chuyển đổi số` |
| `slidercap1` | `<p>Khám phá các khóa học mới...</p>` |
| `sliderboxes1` | [JSON Array - xem dưới] |

**`sliderboxes1` JSON:**

```json
[
  {
    "boximage": "https://example.com/img/basic.jpg",
    "boxtitle": "Kỹ năng số cơ bản",
    "buttontext": "VÀO HỌC NGAY",
    "buttonlink": "https://example.com/course/basic"
  },
  {
    "boximage": "https://example.com/img/advanced.jpg",
    "boxtitle": "Kỹ năng số nâng cao",
    "buttontext": "VÀO HỌC NGAY",
    "buttonlink": "https://example.com/course/advanced"
  }
]
```

---

## 🎯 Hình Ảnh Minh Họa

### **Cấu trúc Visual:**

```
SLIDE FRONTPAGE
┌─────────────────────────────────────────────────────────┐
│                                                         │
│            [Hình nền - sliderimage1]                   │
│                                                         │
│  ╔═════════════════════════════════════════════════╗   │
│  ║ BÌNH DÂN HỌC VỤ SỐ 2026                         ║   │
│  ║ (slide-title - Màu vàng)                        ║   │
│  ║                                                 ║   │
│  ║ Thị đưa đôi mới sáng tạo và chuyển đổi số      ║   │
│  ║ (slide-subtitle - Màu trắng)                   ║   │
│  ║                                                 ║   │
│  ║ ┌──────────────┐  ┌──────────────┐             ║   │
│  ║ │  [Hình 1]    │  │  [Hình 2]    │             ║   │
│  ║ │              │  │              │             ║   │
│  ║ │ Kỹ năng số   │  │ Kỹ năng số   │             ║   │
│  ║ │  cơ bản      │  │  nâng cao    │             ║   │
│  ║ │              │  │              │             ║   │
│  ║ │ [VÀO HỌC]   │  │ [VÀO HỌC]   │             ║   │
│  ║ └──────────────┘  └──────────────┘             ║   │
│  ║                                                 ║   │
│  ╚═════════════════════════════════════════════════╝   │
│                                                         │
└─────────────────────────────────────────────────────────┘
```

---

## 💾 Cách Thêm Dữ Liệu

### **Bước 1: Truy cập Moodle Admin**
```
Site Administration 
  > Appearance 
    > Themes 
      > Moove Theme
```

### **Bước 2: Điền thông tin**

1. **Slide Count**: Nhập `2` (hoặc số lượng slide bạn muốn)
2. **Nhấn Save** để tạo các field input
3. **Upload Hình nền** (`sliderimage1`, `sliderimage2`, ...)
4. **Nhập Tiêu đề** (`slidertitle1`, `slidertitle2`, ...)
5. **Nhập Phụ đề** (`slidesubtitle1`, `slidesubtitle2`, ...)
6. **Nhập JSON Boxes** (`sliderboxes1`, `sliderboxes2`, ...) - **Copy-paste JSON**
7. **Nhấn Save** lưu tất cả

### **Bước 3: Kiểm tra**
- Truy cập Frontpage (trang chủ)
- Slide sẽ hiển thị với tất cả boxes

---

## ⚠️ Lưu Ý Quan Trọng

### **1. JSON Format**
- Phải là **valid JSON** (đúng format)
- Kiểm tra tại: https://jsonlint.com/
- Nếu sai JSON, boxes sẽ không hiển thị

### **2. URL Hình Ảnh**
- Phải là **absolute URL** (đủ domain)
- Ví dụ: `https://example.com/images/image.jpg`
- ❌ Sai: `/images/image.jpg` (relative)

### **3. Link Nút Bấm**
- Có thể là:
  - Absolute URL: `https://example.com/course`
  - Relative: `/course/view.php?id=2`
  - Anchor: `#section-id`

### **4. Text Buttons**
- Có thể là bất kỳ text nào
- Ví dụ: "VÀO HỌC NGAY", "ĐĂNG KÝ", "TÌM HIỂU THÊM", ...

---

## 🐛 Troubleshooting

### **Boxes không hiển thị**
1. Kiểm tra JSON format có đúng không (dùng jsonlint.com)
2. Kiểm tra URL hình ảnh có hợp lệ không
3. Xóa cache Moodle: **Purge All Caches**

### **Hình ảnh không load**
1. Kiểm tra URL đúng chưa
2. Kiểm tra quyền truy cập file
3. Kiểm tra CDN/proxy có chặn không

### **Text hiển thị sai**
1. Kiểm tra encoding (phải là UTF-8)
2. Kiểm tra special characters `"`, `'`, `&` có escape chưa

---

## 📞 Hỗ Trợ Thêm

Nếu có vấn đề, kiểm tra:
- [SLIDE_CUSTOMIZATION_GUIDE.md](SLIDE_CUSTOMIZATION_GUIDE.md) - Hướng dẫn chi tiết
- [templates/frontpage.mustache](templates/frontpage.mustache) - HTML template
- [scss/moove/_frontpage.scss](scss/moove/_frontpage.scss) - CSS styling

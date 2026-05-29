# راهنمای توسعه‌دهندگان - IslamNET

## فهرست مطالب
1. [نصب و راه‌اندازی](#نصب-و-راه‌اندازی)
2. [ساختار پروژه](#ساختار-پروژه)
3. [توابع کلیدی](#توابع-کلیدی)
4. [API‌های سفارشی](#api‌های-سفارشی)
5. [Hook‌ها و Filter‌ها](#hook‌ها-و-filter‌ها)
6. [بهترین روش‌ها](#بهترین-روش‌ها)
7. [رفع مشکلات](#رفع-مشکلات)

## نصب و راه‌اندازی

### نیازمندی‌ها
- PHP 7.4+
- WordPress 5.9+
- MySQL 5.7+
- Composer (اختیاری)

### مراحل نصب
```bash
# ۱. کلون کردن پروژه
git clone https://github.com/QalamHipHop/ISLAMNET.git
cd ISLAMNET

# ۲. نصب WordPress
# (دنبال کنید تا مراحل نصب معمول WordPress)

# ۳. فعال‌سازی قالب
# در داشبورد WordPress: Appearance > Themes > Activate IslamNET

# ۴. نصب افزونه‌های مورد نیاز
# از طریق Setup Wizard یا دستی
```

## ساختار پروژه

```
ISLAMNET/
├── assets/
│   ├── css/
│   │   ├── main.css           # استایل‌های اصلی
│   │   ├── rtl.css            # استایل‌های RTL
│   │   └── buddypress-custom.css
│   ├── js/
│   │   └── main.js            # اسکریپت‌های اصلی
│   └── images/
├── inc/
│   ├── helpers/
│   │   ├── helper-functions.php      # توابع کمکی
│   │   └── buddypress-integration.php # ادغام BuddyPress
│   ├── setup/
│   │   └── class-islamnet-setup-wizard.php
│   ├── widgets/
│   │   └── custom-widgets.php
│   ├── demo-content/
│   │   ├── content.xml
│   │   ├── customizer.dat
│   │   └── widgets.wie
│   ├── tgmpa/
│   │   └── class-tgm-plugin-activation.php
│   └── Merlin/
├── template-parts/
│   ├── header/
│   ├── content/
│   └── footer/
├── functions.php              # فایل اصلی قالب
├── index.php
├── style.css
├── ARCHITECTURE.md            # معماری پروژه
└── README.md
```

## توابع کلیدی

### ۱. توابع مذهبی

#### `islamnet_get_prayer_times($city, $country, $method)`
```php
// دریافت اوقات شرعی برای شهر و کشور مشخص
$prayer_times = islamnet_get_prayer_times('Tehran', 'Iran', '2');

// خروجی:
// Array (
//     'Fajr' => '04:15',
//     'Sunrise' => '05:45',
//     'Dhuhr' => '13:05',
//     'Asr' => '16:50',
//     'Maghrib' => '20:10',
//     'Isha' => '21:45',
//     'date' => 'Thursday, 30 May 2024',
//     'hijri' => '1445/12/22'
// )
```

#### `islamnet_get_hijri_date($date)`
```php
// تبدیل تاریخ میلادی به هجری
$hijri = islamnet_get_hijri_date();  // تاریخ امروز
$hijri = islamnet_get_hijri_date('2024-05-30');  // تاریخ مشخص

// خروجی: "1445/12/22"
```

#### `islamnet_display_prayer_times_widget($city, $country)`
```php
// نمایش ویجت اوقات شرعی
echo islamnet_display_prayer_times_widget('Tehran', 'Iran');
```

### ۲. توابع BuddyPress

#### `islamnet_bp_is_active()`
```php
// بررسی فعال بودن BuddyPress
if (islamnet_bp_is_active()) {
    // کد مربوط به BuddyPress
}
```

#### `islamnet_add_religious_profile_fields()`
```php
// اضافه کردن فیلدهای دینی به پروفایل
// این تابع خودکار هنگام فعال‌سازی قالب فراخوانی می‌شود
```

### ۳. توابع کمکی

#### `islamnet_get_option($option_id, $default)`
```php
// دریافت تنظیمات قالب
$primary_color = islamnet_get_option('islamnet_primary_color', '#1a5490');
```

#### `islamnet_is_learnpress_active()`
```php
// بررسی فعال بودن LearnPress
if (islamnet_is_learnpress_active()) {
    // کد مربوط به LearnPress
}
```

## API‌های سفارشی

### Prayer Times API

**Endpoint**: `/wp-json/islamnet/v1/prayer-times`

**Method**: GET

**Parameters**:
- `city` (required): نام شهر
- `country` (required): نام کشور
- `method` (optional): روش محاسبه (پیش‌فرض: 2)

**Example**:
```bash
curl "https://yoursite.com/wp-json/islamnet/v1/prayer-times?city=Tehran&country=Iran"
```

**Response**:
```json
{
  "success": true,
  "data": {
    "Fajr": "04:15",
    "Sunrise": "05:45",
    "Dhuhr": "13:05",
    "Asr": "16:50",
    "Maghrib": "20:10",
    "Isha": "21:45",
    "date": "Thursday, 30 May 2024",
    "hijri": "1445/12/22"
  }
}
```

### Hijri Date API

**Endpoint**: `/wp-json/islamnet/v1/hijri-date`

**Method**: GET

**Parameters**:
- `date` (optional): تاریخ میلادی (YYYY-MM-DD)

**Example**:
```bash
curl "https://yoursite.com/wp-json/islamnet/v1/hijri-date?date=2024-05-30"
```

## Hook‌ها و Filter‌ها

### Action Hooks

#### `islamnet_after_prayer_times_loaded`
```php
add_action('islamnet_after_prayer_times_loaded', function($prayer_times) {
    // کدی که بعد از بارگذاری اوقات شرعی اجرا شود
});
```

#### `islamnet_before_profile_fields`
```php
add_action('islamnet_before_profile_fields', function() {
    // کدی که قبل از نمایش فیلدهای پروفایل اجرا شود
});
```

### Filter Hooks

#### `islamnet_prayer_times_cache_duration`
```php
add_filter('islamnet_prayer_times_cache_duration', function($duration) {
    // تغییر مدت زمان کش (پیش‌فرض: 24 ساعت)
    return 12 * HOUR_IN_SECONDS;
});
```

#### `islamnet_hijri_date_format`
```php
add_filter('islamnet_hijri_date_format', function($format) {
    // تغییر فرمت تاریخ هجری
    return 'YYYY/MM/DD';
});
```

## بهترین روش‌ها

### ۱. امنیت

```php
// استفاده از nonce برای فرم‌ها
wp_nonce_field('islamnet_action', 'islamnet_nonce');

// بررسی nonce
if (!isset($_POST['islamnet_nonce']) || 
    !wp_verify_nonce($_POST['islamnet_nonce'], 'islamnet_action')) {
    die('Security check failed');
}

// Sanitize ورودی‌ها
$city = sanitize_text_field($_POST['city']);

// Escape خروجی‌ها
echo esc_html($prayer_times['Fajr']);
```

### ۲. عملکرد

```php
// استفاده از Transients برای کش
$prayer_times = get_transient('islamnet_prayer_times_' . md5($city . $country));

if (false === $prayer_times) {
    // دریافت داده‌ها از API
    $prayer_times = islamnet_get_prayer_times($city, $country);
    
    // ذخیره در کش برای 24 ساعت
    set_transient('islamnet_prayer_times_' . md5($city . $country), 
                  $prayer_times, 
                  DAY_IN_SECONDS);
}
```

### ۳. سازگاری

```php
// بررسی وجود تابع قبل از استفاده
if (function_exists('islamnet_get_prayer_times')) {
    $prayer_times = islamnet_get_prayer_times('Tehran', 'Iran');
}

// بررسی فعال بودن افزونه
if (class_exists('BuddyPress')) {
    // کد مربوط به BuddyPress
}
```

### ۴. Internationalization

```php
// استفاده از ترجمه‌ها
echo __('Prayer Times', 'islamnet');
echo _e('Islamic Information', 'islamnet');

// استفاده از plurals
_n('course', 'courses', $count, 'islamnet');
```

## رفع مشکلات

### مشکل: اوقات شرعی نمایش داده نمی‌شوند

**راه‌حل**:
1. بررسی فعال بودن افزونه‌های مورد نیاز
2. بررسی اتصال اینترنت
3. بررسی API Aladhan
4. چک کردن لاگ‌های WordPress

```php
// فعال کردن Debug Mode
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

// بررسی لاگ‌ها
tail -f wp-content/debug.log
```

### مشکل: عملکرد کند

**راه‌حل**:
1. فعال کردن کش
2. بهینه‌سازی پایگاه داده
3. استفاده از CDN
4. کاهش تعداد درخواست‌های API

```php
// فعال کردن کش
define('WP_CACHE', true);

// استفاده از Redis
define('WP_REDIS_HOST', 'localhost');
define('WP_REDIS_PORT', 6379);
```

### مشکل: مشکلات RTL

**راه‌حل**:
1. بررسی صحیح بودن تنظیمات RTL
2. بررسی فایل rtl.css
3. تست در مرورگرهای مختلف

```php
// بررسی RTL
if (is_rtl()) {
    wp_enqueue_style('islamnet-rtl', ISLAMNET_THEME_ASSETS . '/css/rtl.css');
}
```

## منابع مفید

- [WordPress Plugin Development](https://developer.wordpress.org/plugins/)
- [BuddyPress Developer Documentation](https://buddypress.org/developers/)
- [LearnPress Documentation](https://learnpress.io/documentation/)
- [Aladhan API Documentation](https://aladhan.com/prayer-times-api)

---

**نسخه**: 2.0
**آخرین به‌روزرسانی**: 2024
**نویسنده**: Manus AI

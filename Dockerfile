# استخدم صورة PHP-FPM الرسمية (مثال: يمكنك تعديل 8.3-fpm حسب إصدار PHP الذي تفضله)
FROM php:8.3-fpm

# 1. تثبيت الاعتماديات الأساسية المطلوبة
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \# استخدام صورة PHP-FPM الرسمية (php:8.3-fpm)
FROM php:8.3-fpm

# 1. تثبيت الاعتماديات الأساسية المطلوبة:
#    - default-mysql-client لتثبيت pdo_mysql.
#    - curl لتنزيل Composer.
#    - zip, git, libonig-dev, libzip-dev هي متطلبات Laravel الأساسية.
#    - libicu-dev و intl لتفعيل امتداد intl (مهم لبعض حزم Laravel).
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    curl \
    git \
    libonig-dev \
    libzip-dev \
    libicu-dev \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# 2. تفعيل امتدادات PHP الضرورية:
#    - pdo, pdo_mysql (لحل المشكلة الأولى).
#    - opcache لتحسين الأداء.
#    - intl (مهم للغات والترميز).
#    - bcmath و ctype (متطلبات Laravel).
RUN docker-php-ext-install pdo pdo_mysql opcache intl bcmath ctype

# ****************************************
# ********* تثبيت Composer الآن *********
# ****************************************
# تنزيل Composer وجعله متاحًا عالميًا (composer)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# ****************************************

# 3. تعيين دليل العمل ونسخ الملفات
WORKDIR /app
COPY . /app

# 4. تثبيت حزم Composer (سيتم تنفيذه بنجاح الآن)
RUN composer install --no-dev --optimize-autoloader

# 5. تعيين الصلاحيات الصحيحة لمجلدات Laravel (storage)
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# تشغيل خادم الويب (PHP-FPM)
CMD ["php-fpm"]
    libonig-dev \
    default-mysql-client \
    # إضافة curl لتنزيل composer
    curl \
    && rm -rf /var/lib/apt/lists/*

# 2. تفعيل امتدادات PHP الضرورية، وأهمها pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql zip opcache

# ****************************************
# ********* إضافة تثبيت Composer *********
# ****************************************
# تنزيل Composer وجعله متاحاً كأمر تنفيذي
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# ****************************************
# ****************************************

# 3. تعيين دليل العمل ونسخ الملفات
WORKDIR /app
COPY . /app

# 4. تثبيت حزم Composer (الآن سيجد الأمر)
RUN composer install --no-dev --optimize-autoloader

# 5. تعيين الصلاحيات الصحيحة لمجلدات Laravel
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# تشغيل خادم الويب (PHP-FPM)
CMD ["php-fpm"]

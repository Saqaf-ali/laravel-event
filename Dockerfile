# استخدام صورة PHP-FPM الرسمية (مثال: يمكنك تعديل 8.3-fpm حسب إصدار PHP الذي تفضله)
FROM php:8.3-fpm

# تثبيت الاعتماديات الأساسية المطلوبة لتشغيل MySQL و Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    libonig-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# تفعيل امتدادات PHP الضرورية، وأهمها pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql zip opcache

# تعيين دليل العمل
WORKDIR /app
COPY . /app

# تثبيت حزم Composer
RUN composer install --no-dev --optimize-autoloader

# تعيين الصلاحيات الصحيحة لمجلدات Laravel
# هذا ضروري لتجنب أخطاء كتابة التخزين (storage)
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# تشغيل خادم الويب (PHP-FPM)
CMD ["php-fpm"]

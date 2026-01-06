FROM php:8.2-apache

# Copy toàn bộ mã nguồn vào thư mục web của Apache
COPY . /var/www/html/

# Bật module rewrite (phòng khi dùng URL đẹp)
RUN a2enmod rewrite

# Phân quyền thư mục
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CREATE TABLE banner (id BIGINT AUTO_INCREMENT, site_id BIGINT NOT NULL, display_type SMALLINT DEFAULT 0 NOT NULL, url TEXT, url_predefined TEXT, filename VARCHAR(255), html_alt VARCHAR(255), html_title VARCHAR(255), title VARCHAR(255), head_title VARCHAR(255), head_text TEXT, head_icon TEXT, description LONGTEXT, content LONGTEXT, template BIGINT, custom_code LONGTEXT, is_target_blank TINYINT(1) DEFAULT '0' NOT NULL, is_active TINYINT(1) DEFAULT '1' NOT NULL, show_title TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, position BIGINT, UNIQUE INDEX banner_position_sortable_idx (position, site_id, display_type), INDEX site_id_idx (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE catalogue (cat_id BIGINT AUTO_INCREMENT, name VARCHAR(100), source_lang VARCHAR(100), target_lang VARCHAR(100), date_created BIGINT, date_modified BIGINT, author VARCHAR(255), PRIMARY KEY(cat_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE cms (id BIGINT AUTO_INCREMENT, site_id BIGINT, title_general VARCHAR(255) NOT NULL, title VARCHAR(255), role VARCHAR(255), description LONGTEXT, content LONGTEXT, is_active TINYINT(1) DEFAULT '0', html_title TEXT, meta_title TEXT, meta_description LONGTEXT, meta_keywords LONGTEXT, meta_robots VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), INDEX site_id_idx (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE contact (id BIGINT AUTO_INCREMENT, site_id BIGINT, mail VARCHAR(255), name VARCHAR(255), phone VARCHAR(255), message LONGTEXT, attachment LONGTEXT, ip_address VARCHAR(255), sent_from VARCHAR(255), client_info TEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX site_id_idx (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE option_key (id BIGINT AUTO_INCREMENT, class_type VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, k_group SMALLINT, is_required TINYINT(1) DEFAULT '1' NOT NULL, variable_type VARCHAR(63), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE reference (id BIGINT AUTO_INCREMENT, site_id BIGINT, title_general VARCHAR(255) NOT NULL, title VARCHAR(255), filename VARCHAR(255), video TEXT, description LONGTEXT, content LONGTEXT, is_active TINYINT(1) DEFAULT '0', html_title TEXT, meta_title TEXT, meta_description LONGTEXT, meta_keywords LONGTEXT, meta_robots VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), position BIGINT, UNIQUE INDEX reference_position_sortable_idx (position, site_id), INDEX site_id_idx (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE service (id BIGINT AUTO_INCREMENT, site_id BIGINT, title_general VARCHAR(255) NOT NULL, title VARCHAR(255), description LONGTEXT, content LONGTEXT, is_active TINYINT(1) DEFAULT '0', html_title TEXT, meta_title TEXT, meta_description LONGTEXT, meta_keywords LONGTEXT, meta_robots VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), position BIGINT, UNIQUE INDEX service_position_sortable_idx (position, site_id), INDEX site_id_idx (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE site (id BIGINT AUTO_INCREMENT, name VARCHAR(255), domain VARCHAR(255) NOT NULL, domain_alias LONGTEXT, domain_dev VARCHAR(255), domain_dev_alias LONGTEXT, is_active TINYINT(1) DEFAULT '0' NOT NULL, is_demo TINYINT(1) DEFAULT '0' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE site_menu (id BIGINT AUTO_INCREMENT, site_id BIGINT NOT NULL, parent_id BIGINT, type VARCHAR(63), text VARCHAR(255), icon LONGTEXT, url TEXT, url_predefined TEXT, html_title TEXT, is_highlighted TINYINT(1) DEFAULT '0', is_target_blank TINYINT(1) DEFAULT '0', is_active TINYINT(1) DEFAULT '1', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, position BIGINT, UNIQUE INDEX site_menu_position_sortable_idx (position, parent_id), INDEX parent_id_idx (parent_id), INDEX site_id_idx (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE site_setting (id BIGINT AUTO_INCREMENT, site_id BIGINT, option_key_id BIGINT NOT NULL, s_value LONGTEXT, lang VARCHAR(2), is_active TINYINT(1) DEFAULT '1', priority BIGINT DEFAULT 1 NOT NULL, is_read_only TINYINT(1) DEFAULT '0' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX site_id_idx (site_id), INDEX option_key_id_idx (option_key_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE site_trans_unit (msg_id BIGINT AUTO_INCREMENT, site_id BIGINT NOT NULL, cat_id BIGINT NOT NULL, source TEXT, target TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX site_id_idx (site_id), INDEX cat_id_idx (cat_id), PRIMARY KEY(msg_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE team_member (id BIGINT AUTO_INCREMENT, site_id BIGINT, title_general VARCHAR(255) NOT NULL, title VARCHAR(255), member_position TEXT, filename VARCHAR(255), description LONGTEXT, content LONGTEXT, is_active TINYINT(1) DEFAULT '0', html_title TEXT, meta_title TEXT, meta_description LONGTEXT, meta_keywords LONGTEXT, meta_robots VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), position BIGINT, UNIQUE INDEX team_member_position_sortable_idx (position, site_id), INDEX site_id_idx (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE trans_unit (msg_id BIGINT AUTO_INCREMENT, cat_id BIGINT DEFAULT 1, source TEXT, target TEXT, comments VARCHAR(255), date_added BIGINT DEFAULT 0, date_modified BIGINT DEFAULT 0, author VARCHAR(255), translated TINYINT, INDEX cat_id_idx (cat_id), PRIMARY KEY(msg_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
ALTER TABLE banner ADD CONSTRAINT banner_site_id_site_id FOREIGN KEY (site_id) REFERENCES site(id) ON DELETE CASCADE;
ALTER TABLE cms ADD CONSTRAINT cms_site_id_site_id FOREIGN KEY (site_id) REFERENCES site(id) ON DELETE CASCADE;
ALTER TABLE contact ADD CONSTRAINT contact_site_id_site_id FOREIGN KEY (site_id) REFERENCES site(id) ON DELETE CASCADE;
ALTER TABLE reference ADD CONSTRAINT reference_site_id_site_id FOREIGN KEY (site_id) REFERENCES site(id) ON DELETE CASCADE;
ALTER TABLE service ADD CONSTRAINT service_site_id_site_id FOREIGN KEY (site_id) REFERENCES site(id) ON DELETE CASCADE;
ALTER TABLE site_menu ADD CONSTRAINT site_menu_site_id_site_id FOREIGN KEY (site_id) REFERENCES site(id) ON DELETE RESTRICT;
ALTER TABLE site_menu ADD CONSTRAINT site_menu_parent_id_site_menu_id FOREIGN KEY (parent_id) REFERENCES site_menu(id) ON DELETE CASCADE;
ALTER TABLE site_setting ADD CONSTRAINT site_setting_site_id_site_id FOREIGN KEY (site_id) REFERENCES site(id) ON DELETE CASCADE;
ALTER TABLE site_setting ADD CONSTRAINT site_setting_option_key_id_option_key_id FOREIGN KEY (option_key_id) REFERENCES option_key(id) ON DELETE RESTRICT;
ALTER TABLE site_trans_unit ADD CONSTRAINT site_trans_unit_site_id_site_id FOREIGN KEY (site_id) REFERENCES site(id) ON DELETE CASCADE;
ALTER TABLE site_trans_unit ADD CONSTRAINT site_trans_unit_cat_id_catalogue_cat_id FOREIGN KEY (cat_id) REFERENCES catalogue(cat_id);
ALTER TABLE team_member ADD CONSTRAINT team_member_site_id_site_id FOREIGN KEY (site_id) REFERENCES site(id) ON DELETE CASCADE;
ALTER TABLE trans_unit ADD CONSTRAINT trans_unit_cat_id_catalogue_cat_id FOREIGN KEY (cat_id) REFERENCES catalogue(cat_id);
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;

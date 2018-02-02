CREATE TABLE countries(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    code                        VARCHAR(255),
    abreviation                 VARCHAR(255),
    description                 VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_country PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE departments(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_country                  INT(255),
    code                        VARCHAR(255),
    abreviation                 VARCHAR(255),
    description                 VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_departments PRIMARY KEY (id),
    CONSTRAINT fk_departments_country FOREIGN KEY (id_country) REFERENCES country(id)
)ENGINE = InnoDb;

CREATE TABLE cities(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_departments              INT(255),
    code                        VARCHAR(255),
    abreviation                 VARCHAR(255),
    description                 VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_cities PRIMARY KEY (id),
    CONSTRAINT fk_cities_departments FOREIGN KEY (id_departments) REFERENCES departments(id)
)ENGINE = InnoDb;

CREATE TABLE roles(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    description                 VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_roles PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE sellers_categories(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    description             VARCHAR(255),
    state                   VARCHAR(40),
    CONSTRAINT pk_sellers_categories PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE schools(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_school                   INT(255),
    id_city                     INT(255),
    dane                        VARCHAR(120),
    icfes                       VARCHAR(120),
    nit                         VARCHAR(120),
    description                 VARCHAR(255),
    address                     VARCHAR(255),
    phone                       VARCHAR(255),
    email                       VARCHAR(255),
    web                         VARCHAR(255),
    image                       VARCHAR(255),
    type                        VARCHAR(40),
    state                       VARCHAR(40),
    CONSTRAINT pk_schools PRIMARY KEY (id),
    CONSTRAINT fk_schools_school FOREIGN KEY (id_school) REFERENCES schools(id),
    CONSTRAINT fk_schools_city FOREIGN KEY (id_city) REFERENCES cities(id)
)ENGINE = InnoDb;

CREATE TABLE users(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_role                     INT(255),
    id_seller_category          INT(255),
    id_dad                      INT(255),
    id_mom                      INT(255),
    id_attendant                INT(255),
    id_school                   INT(255),
    id_city                     INT(255),
    name                        VARCHAR(255),
    surname                     VARCHAR(255),
    email                       VARCHAR(255),
    password                    VARCHAR(255),
    address                     VARCHAR(255),
    phone                       VARCHAR(255),
    doc_type                    VARCHAR(255),
    doc_number                  VARCHAR(255),
    birth                       DATETIME,
    gender                      VARCHAR(40),
    civil                       VARCHAR(255),
    profession                  VARCHAR(255),
    fpc                         VARCHAR(255),
    ccf                         VARCHAR(255),
    arp                         VARCHAR(255),
    blood_type                  VARCHAR(40),
    health                      VARCHAR(255),
    image                       VARCHAR(255),
    observations                TEXT,
    created_at                  TIMESTAMP,
    updated_at                  TIMESTAMP,
    deleted_at                  TIMESTAMP,
    state                       VARCHAR(40),
    CONSTRAINT pk_users PRIMARY KEY (id),
    CONSTRAINT fk_users_roles FOREIGN KEY (id_role) REFERENCES roles(id),
    CONSTRAINT fk_users_seller_category FOREIGN KEY (id_seller_category) REFERENCES sellers_categories(id),
    CONSTRAINT fk_users_dad FOREIGN KEY (id_dad) REFERENCES users(id),
    CONSTRAINT fk_users_mom FOREIGN KEY (id_mom) REFERENCES users(id),
    CONSTRAINT fk_users_attendant FOREIGN KEY (id_attendant) REFERENCES users(id),
    CONSTRAINT fk_users_school FOREIGN KEY (id_school) REFERENCES schools(id),
    CONSTRAINT fk_users_cities FOREIGN KEY (id_city) REFERENCES cities(id)
)ENGINE = InnoDb;

CREATE TABLE exp_labors(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_user                     INT(255),
    school                      VARCHAR(255),
    date_ini                    DATETIME,
    date_fin                    DATETIME,
    state                       VARCHAR(40),
    CONSTRAINT pk_exp_labors PRIMARY KEY (id),
    CONSTRAINT fk_exp_labors_users FOREIGN KEY (id_user) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE exp_professionals(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_user                     INT(255),
    school                      VARCHAR(255),
    date_ini                    DATETIME,
    date_fin                    DATETIME,
    state                       VARCHAR(40),
    CONSTRAINT pk_exp_professionals PRIMARY KEY (id),
    CONSTRAINT fk_exp_prof_users FOREIGN KEY (id_user) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE periods(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_school                   INT(255),
    abreviation                 VARCHAR(120),
    description                 VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_periods PRIMARY KEY (id),
    CONSTRAINT fk_periods_school FOREIGN KEY (id_school) REFERENCES schools(id)
)ENGINE = InnoDb;

CREATE TABLE class_periods(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_period                   INT(255),
    description                 VARCHAR(255),
    date_ini                    DATETIME,
    date_fin                    DATETIME,
    percentage                  NUMERIC,
    max_notes                   INT(255),
    registry                    VARCHAR(40),
    state                       VARCHAR(40),
    CONSTRAINT pk_class_periods PRIMARY KEY (id),
    CONSTRAINT fk_class_per_period FOREIGN KEY (id_period) REFERENCES periods(id)
)ENGINE = InnoDb;

CREATE TABLE lounges(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_school                   INT(255),
    lounge                      VARCHAR(255),
    description                 VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_lounges PRIMARY KEY (id),
    CONSTRAINT fk_lounges_school FOREIGN KEY (id_school) REFERENCES schools(id)
)ENGINE = InnoDb;

CREATE TABLE areas(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_school                   INT(255),
    abreviation                 VARCHAR(255),
    description                 VARCHAR(255),
    color                       VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_areas PRIMARY KEY (id),
    CONSTRAINT fk_areas_school FOREIGN KEY (id_school) REFERENCES schools(id)
)ENGINE = InnoDb;

CREATE TABLE subjects(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_area                     INT(255),
    abreviation                 VARCHAR(255),
    description                 VARCHAR(255),
    color                       VARCHAR(255),
    priority                    INT(255),
    include                     VARCHAR(40),
    state                       VARCHAR(40),
    CONSTRAINT pk_subjects PRIMARY KEY (id),
    CONSTRAINT fk_subjects_area FOREIGN KEY (id_area) REFERENCES areas(id)
)ENGINE = InnoDb;

CREATE TABLE grades(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_school                   INT(255),
    abreviation                 VARCHAR(255),
    description                 VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_grades PRIMARY KEY (id),
    CONSTRAINT fk_grades_school FOREIGN KEY (id_school) REFERENCES schools(id)
)ENGINE = InnoDb;

CREATE TABLE groups(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_school                   INT(255),
    id_period                   INT(255),
    id_grade                    INT(255),
    id_user                     INT(255),
    abreviation                 VARCHAR(255),
    description                 VARCHAR(255),
    count                       INT(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_groups PRIMARY KEY (id),
    CONSTRAINT fk_groups_school FOREIGN KEY (id_school) REFERENCES schools(id),
    CONSTRAINT fk_groups_period FOREIGN KEY (id_period) REFERENCES periods(id),
    CONSTRAINT fk_groups_grade FOREIGN KEY (id_grade) REFERENCES grades(id),
    CONSTRAINT fk_groups_user FOREIGN KEY (id_user) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE grade_student(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_group                    INT(255),
    id_user                     INT(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_grade_student PRIMARY KEY (id),
    CONSTRAINT fk_grade_stu_group FOREIGN KEY (id_group) REFERENCES groups(id),
    CONSTRAINT fk_grade_stu_user FOREIGN KEY (id_user) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE schedules(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_period                   INT(255),
    id_user                     INT(255),
    id_group                    INT(255),
    id_subjects                 INT(255),
    calendar_day                VARCHAR(255),
    calendar_hour               VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_schedules PRIMARY KEY (id),
    CONSTRAINT fk_schedules_periods FOREIGN KEY (id_period) REFERENCES periods(id),
    CONSTRAINT fk_schedules_users FOREIGN KEY (id_user) REFERENCES users(id),
    CONSTRAINT fk_schedules_groups FOREIGN KEY (id_group) REFERENCES groups(id),
    CONSTRAINT fk_schedules_subjects FOREIGN KEY (id_subjects) REFERENCES subjects(id)
)ENGINE = InnoDb;

CREATE TABLE absences(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_class_period             INT(255),
    id_user                     INT(255),
    id_subject                  INT(255),
    date_ini                    DATETIME,
    date_fin                    DATETIME,
    justified                   VARCHAR(40),
    observations                TEXT,
    state                       VARCHAR(40),
    CONSTRAINT pk_absences PRIMARY KEY (id),
    CONSTRAINT fk_absences_class_periods FOREIGN KEY (id_class_period) REFERENCES class_periods(id),
    CONSTRAINT fk_absences_users FOREIGN KEY (id_user) REFERENCES users(id),
    CONSTRAINT fk_absences_subject FOREIGN KEY (id_subject) REFERENCES subjects(id)
)ENGINE = InnoDb;

CREATE TABLE suppliers(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_school                   INT(255),
    id_user                     INT(255),
    description                 VARCHAR(255),
    address                     VARCHAR(255),
    phone                       VARCHAR(120),
    email                       VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_suppliers PRIMARY KEY (id),
    CONSTRAINT fk_suppliers_school FOREIGN KEY (id_school) REFERENCES schools(id),
    CONSTRAINT fk_suppliers_users FOREIGN KEY (id_user) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE vehicles(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_supplier                 INT(255),
    id_school                   INT(255),
    id_user                     INT(255),
    placa                       VARCHAR(20),
    brand                       VARCHAR(120),
    model                       VARCHAR(20),
    capacity                    INT(255),
    insurance                   VARCHAR(255),
    phone                       VARCHAR(120),
    expiration                  DATETIME,
    state                       VARCHAR(40),
    CONSTRAINT pk_vehicles PRIMARY KEY (id),
    CONSTRAINT fk_vehicles_supplier FOREIGN KEY (id_supplier) REFERENCES suppliers(id),
    CONSTRAINT fk_vehicles_school FOREIGN KEY (id_school) REFERENCES schools(id),
    CONSTRAINT fk_vehicles_user FOREIGN KEY (id_user) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE routes(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_vehicle                  INT(255),
    description                 VARCHAR(255),
    observations                TEXT,
    state                       VARCHAR(40),
    CONSTRAINT pk_routes PRIMARY KEY (id),
    CONSTRAINT fk_routes_vehicles FOREIGN KEY (id_vehicle) REFERENCES vehicles(id)
)ENGINE = InnoDb;

CREATE TABLE stops(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_route                    INT(255),
    address                     VARCHAR(255),
    time_stop                   TIME,
    observations                TEXT,
    state                       VARCHAR(40),
    CONSTRAINT pk_stops PRIMARY KEY (id),
    CONSTRAINT fk_stops FOREIGN KEY (id_route) REFERENCES routes(id)
)ENGINE = InnoDb;

CREATE TABLE assignment(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_route                    INT(255),
    id_user                     INT(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_assignment PRIMARY KEY (id),
    CONSTRAINT fk_assignment_routes FOREIGN KEY (id_route) REFERENCES routes(id),
    CONSTRAINT fk_assignment_users FOREIGN KEY (id_user) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE binnacle_type(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    description                 VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_binnacle_type PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE binnacle(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_class_period             INT(255),
    id_user                     INT(255),
    id_binnacle_type            INT(255),
    date_log                    DATETIME,
    title                       VARCHAR(255),
    description                 TEXT,
    state                       VARCHAR(40),
    CONSTRAINT pk_binnacle PRIMARY KEY (id),
    CONSTRAINT fk_binnacle_classper FOREIGN KEY (id_class_period) REFERENCES class_periods(id),
    CONSTRAINT fk_binnacle_user FOREIGN KEY (id_user) REFERENCES users(id),
    CONSTRAINT fk_binnacle_binntype FOREIGN KEY (id_binnacle_type) REFERENCES binnacle_type(id)
)ENGINE = InnoDb;

CREATE TABLE regulations(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_school                   INT(255),
    id_period                   INT(255),
    type                        VARCHAR(120),
    minimum                     NUMERIC,
    maximum                     NUMERIC,
    min_approval                NUMERIC,
    pos_decimal                 INT(255),
    formula                     VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_regulations PRIMARY KEY (id),
    CONSTRAINT fk_regulations_school FOREIGN KEY (id_school) REFERENCES schools(id),
    CONSTRAINT fk_regulations_period FOREIGN KEY (id_period) REFERENCES periods(id)
)ENGINE = InnoDb;

CREATE TABLE criteria(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_regulation               INT(255),
    abreviation                 VARCHAR(20),
    description                 VARCHAR(255),
    minimum                     NUMERIC,
    maximum                     NUMERIC,
    color                       VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_criteria PRIMARY KEY (id),
    CONSTRAINT fk_criteria_regulation FOREIGN KEY (id_regulation) REFERENCES regulations(id)
)ENGINE = InnoDb;

CREATE TABLE questions(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    context                     TEXT,
    context_image               VARCHAR(255),
    description                 TEXT,
    image                       VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_questions PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE questions_users(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_question                 INT(255),
    id_user                     INT(255),
    date_updated                DATETIME,
    description                 VARCHAR(120),
    state                       VARCHAR(40),
    CONSTRAINT pk_questions_users PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE answers(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_question                 INT(255),
    description                 TEXT,
    image                       VARCHAR(255),
    correct                     VARCHAR(40),
    order_by                    INT(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_answers PRIMARY KEY (id),
    CONSTRAINT fk_answers_questions FOREIGN KEY (id_question) REFERENCES questions(id)
)ENGINE = InnoDb;

CREATE TABLE evaluations(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    code                        VARCHAR(255),
    description                 VARCHAR(255),
    image                       VARCHAR(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_evaluations PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE sessions(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_evaluations              INT(255),
    abreviation                 VARCHAR(120),
    description                 VARCHAR(255),
    order_by                    INT(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_sessions PRIMARY KEY (id),
    CONSTRAINT fk_sessions_evaluations FOREIGN KEY (id_evaluations) REFERENCES evaluations(id)
)ENGINE = InnoDb;

CREATE TABLE session_subject(
    id                          INT(255) AUTO_INCREMENT NOT NULL,
    id_session                  INT(255),
    id_subject                  INT(255),
    count                       INT(255),
    question_firt               INT(255),
    order_by                    INT(255),
    state                       VARCHAR(40),
    CONSTRAINT pk_session_subject PRIMARY KEY (id),
    CONSTRAINT fk_session_sub_session FOREIGN KEY (id_session) REFERENCES sessions(id),
    CONSTRAINT fk_session_sub_subject FOREIGN KEY (id_subject) REFERENCES subjects(id)
)ENGINE = InnoDb;

CREATE TABLE products_categories(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    description             VARCHAR(255),
    state                   VARCHAR(40),
    CONSTRAINT pk_products_categories PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE value_seller_product(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    id_seller_category      INT(255),
    id_product_category     INT(255),
    price_product           NUMERIC,
    price_premarcado        NUMERIC,
    price_calificado        NUMERIC,
    price_planb             NUMERIC,
    state                   VARCHAR(40),
    CONSTRAINT pk_value_seller_product PRIMARY KEY (id),
    CONSTRAINT fk_vsp_seller_category FOREIGN KEY (id_seller_category) REFERENCES sellers_categories(id),
    CONSTRAINT fk_vsp_product_category FOREIGN KEY (id_product_category) REFERENCES products_categories(id)
)ENGINE = InnoDb;

CREATE TABLE wineries(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    description             VARCHAR(255),
    state                   VARCHAR(40),
    CONSTRAINT pk_wineries PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE products(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    id_wineries             INT(255),
    id_product_category     INT(255),
    code                    VARCHAR(40),
    description             VARCHAR(255),
    quantity                INTEGER(255),
    price                   NUMERIC,
    existence               INT(255),
    order_producto          INT(255),
    new_order               INT(255),
    image                   VARCHAR(255),
    state                   VARCHAR(40),
    CONSTRAINT pk_products PRIMARY KEY (id),
    CONSTRAINT fk_products_wineries FOREIGN KEY (id_wineries) REFERENCES wineries(id),
    CONSTRAINT fk_products_product_cat FOREIGN KEY (id_product_category) REFERENCES products_categories(id)
)ENGINE = InnoDb;

CREATE TABLE incomes(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    code                    VARCHAR(40),
    description             VARCHAR(255),
    state                   VARCHAR(40),
    CONSTRAINT pk_incomes PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE product_incomes(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    id_income               INT(255),
    id_product              INT(255),
    quantity                INT(255),
    state                   VARCHAR(40),
    CONSTRAINT pk_product_incomes PRIMARY KEY (id),
    CONSTRAINT fk_product_incomes_income FOREIGN KEY (id_income) REFERENCES incomes(id),
    CONSTRAINT fk_product_incomes_product FOREIGN KEY (id_product) REFERENCES products(id)
)ENGINE = InnoDb;

CREATE TABLE shipping(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    description             VARCHAR(255),
    phone                   VARCHAR(120),
    state                   VARCHAR(40),
    CONSTRAINT pk_shipping PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE shipping_type(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    description             VARCHAR(255),
    state                   VARCHAR(40),
    CONSTRAINT pk_shipping_type PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE order_type(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    description             VARCHAR(255),
    state                   VARCHAR(40),
    CONSTRAINT pk_order_type PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE orders(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    id_seller               INT(255),
    id_school               INT(255),
    id_ship                 INT(255),
    id_ship_type            INT(255),
    id_order_type           INT(255),
    id_city                 INT(255),
    code                    VARCHAR(120),
    guia                    VARCHAR(40),
    previous_order          INT(255),
    created_at              DATETIME,
    updated_at              DATETIME,
    canceled_at             DATETIME,
    date_application        DATETIME,
    date_ship               DATETIME,
    date_return             DATETIME,
    observations            TEXT,
    ship_name               VARCHAR(255),
    ship_to                 VARCHAR(255),
    ship_address            VARCHAR(255),
    ship_phone              VARCHAR(255),
    total                   NUMERIC,
    state                   VARCHAR(40),
    CONSTRAINT pk_orders PRIMARY KEY (id),
    CONSTRAINT fk_orders_seller FOREIGN KEY (id_seller) REFERENCES users(id),
    CONSTRAINT fk_orders_school FOREIGN KEY (id_school) REFERENCES schools(id),
    CONSTRAINT fk_orders_shipping FOREIGN KEY (id_ship) REFERENCES shipping(id),
    CONSTRAINT fk_orders_shipping_type FOREIGN KEY (id_ship_type) REFERENCES shipping_type(id),
    CONSTRAINT fk_orders_order_type FOREIGN KEY (id_order_type) REFERENCES order_type(id),
    CONSTRAINT fk_orders_cities FOREIGN KEY (id_city) REFERENCES cities(id)
)ENGINE = InnoDb;

CREATE TABLE order_details(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    id_order                INT(255),
    id_product              INT(255),
    id_caliidn              INT (255),
    caliidn                 INT (255),
    quantity_order          INT(255),
    quantity_premarcado     INT(255),
    quantity_calificado     INT(255),
    quantity_planb          INT(255),
    price_order             NUMERIC,
    price_premarcado        NUMERIC,
    price_calificado        NUMERIC,
    price_planb             NUMERIC,
    state                   VARCHAR(40),
    CONSTRAINT pk_order_details PRIMARY KEY (id),
    CONSTRAINT fk_order_details_order FOREIGN KEY (id_order) REFERENCES orders(id),
    CONSTRAINT fk_order_details_product FOREIGN KEY (id_product) REFERENCES products(id),
    CONSTRAINT fk_order_details_caliidn FOREIGN KEY (id_caliidn) REFERENCES jl_caliidn(id)
)ENGINE = InnoDb;

CREATE TABLE processes(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    description             VARCHAR(255),
    color                   VARCHAR(40),
    state                   VARCHAR(40),
    CONSTRAINT pk_processes PRIMARY KEY (id)
)ENGINE = InnoDb;

CREATE TABLE processes_state(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    id_process              INT(255),
    description             VARCHAR(255),
    state                   VARCHAR(40),
    CONSTRAINT pk_processes_state PRIMARY KEY (id),
    CONSTRAINT fk_processes_state_process FOREIGN KEY (id_process) REFERENCES processes(id)
)ENGINE = InnoDb;

CREATE TABLE users_per_order(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    id_order                INT(255),
    id_user                 INT(255),
    id_process_state        INT(255),
    created_at              DATETIME,
    state                   VARCHAR(40),
    CONSTRAINT pk_users_per_order PRIMARY KEY (id),
    CONSTRAINT fk_upo_order FOREIGN KEY (id_order) REFERENCES orders(id),
    CONSTRAINT fk_upo_user FOREIGN KEY (id_user) REFERENCES users(id),
    CONSTRAINT fk_upo_process_state FOREIGN KEY (id_process_state) REFERENCES processes_state(id)
)ENGINE = InnoDb;

CREATE TABLE pagos(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    id_seller               INT(255),
    description             TEXT,
    valor                   NUMERIC,
    created_at              DATETIME,
    state                   VARCHAR(40),
    CONSTRAINT pk_pagos PRIMARY KEY (id),
    CONSTRAINT fk_pagos_user FOREIGN KEY (id_seller) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE nota_credito(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    id_seller               INT(255),
    id_user                 INT (255),
    description             TEXT,
    valor                   NUMERIC,
    created_at              DATETIME,
    state                   VARCHAR(40),
    CONSTRAINT pk_nota_credito PRIMARY KEY (id),
    CONSTRAINT fk_nota_credito_seller FOREIGN KEY (id_seller) REFERENCES users(id),
    CONSTRAINT fk_nota_credito_user FOREIGN KEY (id_user) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE nota_debito(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    id_seller               INT(255),
    id_user                 INT (255),
    description             TEXT,
    valor                   NUMERIC,
    created_at              DATETIME,
    state                   VARCHAR(40),
    CONSTRAINT pk_nota_debito PRIMARY KEY (id),
    CONSTRAINT fk_nota_cdebito_seller FOREIGN KEY (id_seller) REFERENCES users(id),
    CONSTRAINT fk_nota_cdebito_user FOREIGN KEY (id_user) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE consignaciones(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    id_seller               INT (255),
    id_user                 INT (255),
    description             TEXT,
    valor                   NUMERIC,
    created_at              DATETIME,
    state                   VARCHAR(40),
    CONSTRAINT pk_consignaciones PRIMARY KEY (id),
    CONSTRAINT fk_consignaciones_seller FOREIGN KEY (id_seller) REFERENCES users(id),
    CONSTRAINT fk_consignaciones_user FOREIGN KEY (id_user) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE cartera(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    id_order                INT(255),
    description             TEXT,
    valor                   NUMERIC,
    created_at              DATETIME,
    abono                   NUMERIC,
    pagado                  VARCHAR (10),
    state                   VARCHAR(40),
    CONSTRAINT pk_cartera PRIMARY KEY (id),
    CONSTRAINT fk_cartera_order FOREIGN KEY (id_order) REFERENCES orders(id)
)ENGINE = InnoDb;

CREATE TABLE abonos(
    id                      INT(255) AUTO_INCREMENT NOT NULL,
    id_consignacion         INT (255),
    id_cartera              INT (255),
    valor                   NUMERIC,
    created_at              DATETIME,
    state                   VARCHAR (40),
    CONSTRAINT pk_abonos PRIMARY KEY (id),
    CONSTRAINT fk_abonos_consign FOREIGN KEY (id_consignacion) REFERENCES consignaciones(id),
    CONSTRAINT fk_abonos_cartera FOREIGN KEY (id_cartera) REFERENCES cartera(id)
)ENGINE = InnoDb;

CREATE TABLE jl_caliidn(
    id                      INT (255) AUTO_INCREMENT NOT NULL,
    id_product              INT (255),
    id_user_p               INT (255),
    id_user_c               INT (255),
    caliidn                 INT (255),
    count_p_s1              INT (255),
    count_p_s2              INT (255),
    count_c_s1              INT (255),
    count_c_s2              INT (255),
    date_p                  TIMESTAMP,
    date_c                  TIMESTAMP,
    state                   VARCHAR (40),
    CONSTRAINT pk_jl_caliidn PRIMARY KEY (id),
    CONSTRAINT fk_jl_caliidn_product FOREIGN KEY (id_product) REFERENCES products(id),
    CONSTRAINT fk_jl_p_user FOREIGN KEY (id_user_p) REFERENCES users(id),
    CONSTRAINT fk_jl_c_user FOREIGN KEY (id_user_c) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE embalajes(
    id                      INT (255) AUTO_INCREMENT NOT NULL,
    id_user                 INT,
    created_at              DATETIME,
    state                   VARCHAR(40),
    CONSTRAINT pk_embalaje PRIMARY KEY (id),
    CONSTRAINT fk_embalaje_user FOREIGN KEY (id_user) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE embalaje_caja(
    id                      INT (255) AUTO_INCREMENT NOT NULL,
    id_embalaje             INT (255),
    description             VARCHAR(20),
    observation             TEXT,
    state                   VARCHAR(40),
    CONSTRAINT pk_embalaje_caja PRIMARY KEY (id),
    CONSTRAINT fk_embalaje_caja_emb FOREIGN KEY (id_embalaje) REFERENCES embalajes(id)
)ENGINE = InnoDb;

CREATE TABLE emb_caja_order(
    id                      INT (255) AUTO_INCREMENT NOT NULL,
    id_embalaje_caja        INT (255),
    id_order                INT (255),
    state                   VARCHAR(40),
    CONSTRAINT pk_emb_caja_order PRIMARY KEY (id),
    CONSTRAINT fk_emb_caja_order_ec FOREIGN KEY (id_embalaje_caja) REFERENCES embalaje_caja(id),
    CONSTRAINT fk_emb_caja_order_or FOREIGN KEY (id_order) REFERENCES orders(id)
)ENGINE = InnoDb;

CREATE TABLE embalaje_pedido(
    id                      INT (255) AUTO_INCREMENT NOT NULL,
    id_embalaje_caja        INT (255),
    id_order_detail         INT (255),
    description             VARCHAR(120),
    caja                    INT (255),
    cantidad                INT (255),
    CONSTRAINT pk_embalaje_pedido PRIMARY KEY (id),
    CONSTRAINT fk_embalaje_pedido_ec FOREIGN KEY (id_embalaje_caja) REFERENCES embalaje_caja(id),
    CONSTRAINT fk_embalaje_pedido_od FOREIGN KEY (id_order_detail) REFERENCES order_details(id)
)ENGINE = InnoDb;
DROP TABLE IF EXISTS supplier_drug;

DROP TABLE IF EXISTS drug;

DROP TABLE IF EXISTS supplier;

DROP TABLE IF EXISTS crawled_data;

DROP TABLE IF EXISTS return_limit;

DROP FUNCTION IF EXISTS getlimit();

DROP INDEX IF EXISTS drug_index;

DROP INDEX IF EXISTS supplier_index;

DROP INDEX IF EXISTS sd_index;

CREATE TABLE crawled_data
(
    supplier_id INTEGER NOT NULL,
    drug_id     INTEGER NOT NULL,
    clean       VARCHAR(256),
    consistence VARCHAR(256)
);
ALTER TABLE crawled_data
    ADD CONSTRAINT pk_crawled_data PRIMARY KEY (supplier_id, drug_id, clean, consistence);

CREATE TABLE return_limit
(
    ret_limit INTEGER NOT NULL
);

CREATE OR REPLACE FUNCTION getlimit()
    RETURNS INTEGER AS
$$
DECLARE
    ret_lim INTEGER;
BEGIN
    SELECT return_limit.ret_limit INTO ret_lim FROM return_limit;

    RETURN ret_lim;
END;
$$
    LANGUAGE plpgsql;


CREATE TABLE drug
(
    drug_id          SERIAL       NOT NULL,
    drug_name        VARCHAR(256) NOT NULL,
    drug_description VARCHAR(512) NOT NULL
);
ALTER TABLE drug
    ADD CONSTRAINT pk_drug PRIMARY KEY (drug_id);

CREATE TABLE supplier
(
    supplier_id   SERIAL       NOT NULL,
    supplier_name VARCHAR(256) NOT NULL
);
ALTER TABLE supplier
    ADD CONSTRAINT pk_supplier PRIMARY KEY (supplier_id);


CREATE TABLE supplier_drug
(
    supplier_id  INTEGER        NOT NULL,
    drug_id      INTEGER        NOT NULL,
    price        INTEGER        NOT NULL,
    clean        VARCHAR(256)   NOT NULL,
    consistence  VARCHAR(256)   NOT NULL,
    rating       DECIMAL(10, 1) NOT NULL,
    availability VARCHAR(256)   NOT NULL
);
ALTER TABLE supplier_drug
    ADD CONSTRAINT pk_supplier_drug PRIMARY KEY (supplier_id, drug_id);

ALTER TABLE supplier_drug
    ADD CONSTRAINT fk_supplier_drug_supplier FOREIGN KEY (supplier_id) REFERENCES supplier (supplier_id) ON DELETE CASCADE;
ALTER TABLE supplier_drug
    ADD CONSTRAINT fk_supplier_drug_drug FOREIGN KEY (drug_id) REFERENCES drug (drug_id) ON DELETE CASCADE;

CREATE INDEX drug_index ON drug (drug_id);

CREATE INDEX supplier_index ON supplier (supplier_id);

CREATE INDEX sd_index ON supplier_drug (supplier_id, drug_id);

COMMIT;

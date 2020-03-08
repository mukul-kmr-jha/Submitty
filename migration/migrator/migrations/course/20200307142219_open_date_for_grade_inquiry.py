"""Migration for a given Submitty course database."""


def up(config, database, semester, course):
    """
    Run up migration.

    :param config: Object holding configuration details about Submitty
    :type config: migrator.config.Config
    :param database: Object for interacting with given database for environment
    :type database: migrator.db.Database
    :param semester: Semester of the course being migrated
    :type semester: str
    :param course: Code of course being migrated
    :type course: str
    """
    database.execute("ALTER TABLE electronic_gradeable DROP CONSTRAINT eg_regrade_request_date_max")
    database.execute("ALTER TABLE electronic_gradeable DROP COLUMN eg_regrade_request_date")
    database.execute("ALTER TABLE electronic_gradeable ADD COLUMN IF NOT EXISTS eg_grade_inquiry_start_date timestamp(6) with time zone")
    database.execute("ALTER TABLE electronic_gradeable ADD COLUMN IF NOT EXISTS eg_grade_inquiry_due_date timestamp(6) with time zone")
    database.execute("UPDATE electronic_gradeable SET eg_grade_inquiry_start_date='9999-01-01 00:00:00.000000', eg_grade_inquiry_due_date='9999-02-01 00:00:00.000000' WHERE eg_grade_inquiry_start_date IS NULL")
    database.execute("ALTER TABLE electronic_gradeable ADD CONSTRAINT eg_grade_inquiry_start_date_max CHECK(eg_grade_inquiry_start_date <= '9999-03-01 00:00:00.000000')")
    database.execute("ALTER TABLE electronic_gradeable ADD CONSTRAINT eg_grade_inquiry_due_date_max CHECK(eg_grade_inquiry_due_date <= '9999-03-01 00:00:00.000000')")



def down(config, database, semester, course):
    """
    Run down migration (rollback).

    :param config: Object holding configuration details about Submitty
    :type config: migrator.config.Config
    :param database: Object for interacting with given database for environment
    :type database: migrator.db.Database
    :param semester: Semester of the course being migrated
    :type semester: str
    :param course: Code of course being migrated
    :type course: str
    """

    database.execute("ALTER TABLE electronic_gradeable DROP CONSTRAINT eg_grade_inquiry_start_date_max")
    database.execute("ALTER TABLE electronic_gradeable DROP CONSTRAINT eg_grade_inquiry_due_date_max")
    database.execute("ALTER TABLE electronic_gradeable DROP COLUMN eg_grade_inquiry_start_date")
    database.execute("ALTER TABLE electronic_gradeable DROP COLUMN eg_grade_inquiry_due_date")
    database.execute("ALTER TABLE electronic_gradeable ADD COLUMN IF NOT EXISTS eg_regrade_request_date timestamp(6) with time zone")
    database.execute("UPDATE electronic_gradeable SET eg_regrade_request_date='9999-02-02' WHERE eg_regrade_request_date IS NULL")
    database.execute("ALTER TABLE electronic_gradeable ADD CONSTRAINT eg_regrade_request_date_max CHECK(eg_regrade_request_date <= '9999-03-01 00:00:00.000000')")

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241004141947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO question (question_text) VALUES ('1 + 1 = ?')");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('3', false, (SELECT id FROM question WHERE question_text = '1 + 1 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('2', true, (SELECT id FROM question WHERE question_text = '1 + 1 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('0', false, (SELECT id FROM question WHERE question_text = '1 + 1 = ?' LIMIT 1))");

        $this->addSql("INSERT INTO question (question_text) VALUES ('2 + 2 = ?')");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('4', true, (SELECT id FROM question WHERE question_text = '2 + 2 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('3 + 1', true, (SELECT id FROM question WHERE question_text = '2 + 2 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('10', false, (SELECT id FROM question WHERE question_text = '2 + 2 = ?' LIMIT 1))");

        $this->addSql("INSERT INTO question (question_text) VALUES ('3 + 3 = ?')");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('1 + 5', true, (SELECT id FROM question WHERE question_text = '3 + 3 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('1', false, (SELECT id FROM question WHERE question_text = '3 + 3 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('6', true, (SELECT id FROM question WHERE question_text = '3 + 3 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('2 + 4', true, (SELECT id FROM question WHERE question_text = '3 + 3 = ?' LIMIT 1))");

        $this->addSql("INSERT INTO question (question_text) VALUES ('4 + 4 = ?')");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('8', true, (SELECT id FROM question WHERE question_text = '4 + 4 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('4', false, (SELECT id FROM question WHERE question_text = '4 + 4 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('0', false, (SELECT id FROM question WHERE question_text = '4 + 4 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('0 + 8', true, (SELECT id FROM question WHERE question_text = '4 + 4 = ?' LIMIT 1))");

        $this->addSql("INSERT INTO question (question_text) VALUES ('5 + 5 = ?')");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('6', false, (SELECT id FROM question WHERE question_text = '5 + 5 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('18', false, (SELECT id FROM question WHERE question_text = '5 + 5 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('10', true, (SELECT id FROM question WHERE question_text = '5 + 5 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('9', false, (SELECT id FROM question WHERE question_text = '5 + 5 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('0', false, (SELECT id FROM question WHERE question_text = '5 + 5 = ?' LIMIT 1))");

        $this->addSql("INSERT INTO question (question_text) VALUES ('6 + 6 = ?')");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('3', false, (SELECT id FROM question WHERE question_text = '6 + 6 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('9', false, (SELECT id FROM question WHERE question_text = '6 + 6 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('0', false, (SELECT id FROM question WHERE question_text = '6 + 6 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('12', true, (SELECT id FROM question WHERE question_text = '6 + 6 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('5 + 7', true, (SELECT id FROM question WHERE question_text = '6 + 6 = ?' LIMIT 1))");

        $this->addSql("INSERT INTO question (question_text) VALUES ('7 + 7 = ?')");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('5', false, (SELECT id FROM question WHERE question_text = '7 + 7 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('14', true, (SELECT id FROM question WHERE question_text = '7 + 7 = ?' LIMIT 1))");

        $this->addSql("INSERT INTO question (question_text) VALUES ('8 + 8 = ?')");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('16', true, (SELECT id FROM question WHERE question_text = '8 + 8 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('12', false, (SELECT id FROM question WHERE question_text = '8 + 8 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('9', false, (SELECT id FROM question WHERE question_text = '8 + 8 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('5', false, (SELECT id FROM question WHERE question_text = '8 + 8 = ?' LIMIT 1))");

        $this->addSql("INSERT INTO question (question_text) VALUES ('9 + 9 = ?')");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('18', true, (SELECT id FROM question WHERE question_text = '9 + 9 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('9', false, (SELECT id FROM question WHERE question_text = '9 + 9 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('17 + 1', true, (SELECT id FROM question WHERE question_text = '9 + 9 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('2 + 16', true, (SELECT id FROM question WHERE question_text = '9 + 9 = ?' LIMIT 1))");

        $this->addSql("INSERT INTO question (question_text) VALUES ('10 + 10 = ?')");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('0', false, (SELECT id FROM question WHERE question_text = '10 + 10 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('2', false, (SELECT id FROM question WHERE question_text = '10 + 10 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('8', false, (SELECT id FROM question WHERE question_text = '10 + 10 = ?' LIMIT 1))");
        $this->addSql("INSERT INTO answer (answer_text, is_correct, question_id) VALUES ('20', true, (SELECT id FROM question WHERE question_text = '10 + 10 = ?' LIMIT 1))");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM answer WHERE question_id IN (SELECT id FROM question WHERE question_text IN (
            '1 + 1 = ?',
            '2 + 2 = ?',
            '3 + 3 = ?',
            '4 + 4 = ?',
            '5 + 5 = ?',
            '6 + 6 = ?',
            '7 + 7 = ?',
            '8 + 8 = ?',
            '9 + 9 = ?',
            '10 + 10 = ?'))");

        $this->addSql("DELETE FROM question WHERE question_text IN (
            '1 + 1 = ?',
            '2 + 2 = ?',
            '3 + 3 = ?',
            '4 + 4 = ?',
            '5 + 5 = ?',
            '6 + 6 = ?',
            '7 + 7 = ?',
            '8 + 8 = ?',
            '9 + 9 = ?',
            '10 + 10 = ?')");
    }
}

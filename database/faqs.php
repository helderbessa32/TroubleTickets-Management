<?php
    declare(strict_types = 1);

    class FAQ {
        public int $id;
        public string $question;
        public string $answer;

        public function __construct(int $id, string $question, string $answer) {
            $this->id = $id;
            $this->question = $question;
            $this->answer = $answer;
        }

        static function getFAQs(PDO $db) : array {
            $stmt = $db->prepare('SELECT * FROM faq');
            $stmt->execute();
            $faqs = $stmt->fetchAll();

            return $faqs;
        }

        static function addFAQ(PDO $db, string $question, string $answer): bool {
            $stmt = $db->prepare('INSERT INTO faq (question, answer) VALUES (?, ?)');
            return $stmt->execute([$question, $answer]);
        }

        static function deleteFAQ(PDO $db, int $id): bool {
            $stmt = $db->prepare('DELETE FROM faq WHERE id = ?');
            return $stmt->execute([$id]);
        }

        static function editFAQ(PDO $db, int $id, string $question, string $answer): bool {
            $stmt = $db->prepare('UPDATE faq SET question = ?, answer = ? WHERE id = ?');
            return $stmt->execute([$question, $answer, $id]);
        }
        

    }
?>
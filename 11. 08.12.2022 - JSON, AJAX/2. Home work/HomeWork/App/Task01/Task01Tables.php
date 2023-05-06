<?php

namespace App\Task01;

// Таблицы
use PDO;

class Task01Tables {
    
    use Task01Trait;
    
    
    // учебные предметы
    public function getAcademicSubject(): array {
        return $this->pdo->query('select * from academic_subjects order by id')
            ->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\AcademicSubject');
    }
    
    
    // экзамены
    public function getExams(): array {
        return $this->pdo->query('select * from exams_view order by id')
            ->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Exam');
    }
    
    
    // экзаменаторы
    public function getExaminers(): array {
        return $this->pdo->query('select * from examiners_view order by id')
            ->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Examiner');
    }
    
    
    // типы экзаменов
    public function getExamTypes(): array {
        return $this->pdo->query('select * from exam_types_view order by id')
            ->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\ExamType');
    }
    
    
    // персоны
    public function getPeople(): array {
        return $this->pdo->query('select * from people order by id')
            ->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Person');
    }
    
    // студенты
    public function getStudents(): array {
        return $this->pdo->query('select * from students_view order by id')
            ->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Student');
    }
}
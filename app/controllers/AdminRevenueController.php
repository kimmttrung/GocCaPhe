<?php

class AdminRevenueController
{
     private $pdo;

     public function __construct() {
        $this->pdo = Database::connect();
    }


    public function index()
    {
        $stmt = $this->pdo->query(
            "SELECT * FROM revenues ORDER BY revenue_date DESC"
        );
        $revenues = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require "../app/views/admin/revenue/index.php";
    }

    public function create()
    {
        require "../app/views/admin/revenue/create.php";
    }

    public function store()
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO revenues (revenue_date, amount, note)
             VALUES (?, ?, ?)"
        );
        $stmt->execute([
            $_POST['revenue_date'],
            $_POST['amount'],
            $_POST['note']
        ]);

        header("Location: ?url=admin/revenue");
        exit;
    }

    public function edit()
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM revenues WHERE id = ?"
        );
        $stmt->execute([$_GET['id']]);
        $revenue = $stmt->fetch(PDO::FETCH_ASSOC);

        require "../app/views/admin/revenue/edit.php";
    }

    public function update()
    {
        $stmt = $this->pdo->prepare(
            "UPDATE revenues
             SET revenue_date = ?, amount = ?, note = ?
             WHERE id = ?"
        );
        $stmt->execute([
            $_POST['revenue_date'],
            $_POST['amount'],
            $_POST['note'],
            $_POST['id']
        ]);

        header("Location: ?url=admin/revenue");
        exit;
    }

    public function delete()
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM revenues WHERE id = ?"
        );
        $stmt->execute([$_GET['id']]);

        header("Location: ?url=admin/revenue");
        exit;
    }
}

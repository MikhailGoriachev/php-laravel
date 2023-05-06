<?php

use App\Task02\Task02Queries;
use App\Task02\Task02Tables;
use Models\Task02\Exam;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$queries = new Task02Queries();

if (isset($_POST['add']))
    $queries->query09(random_int(1, 5), random_int(1, 5), random_int(1, 5),'2021/11/' . random_int(1, 10), random_int(1, 10));

else if (isset($_POST['delete']))
    $queries->query10($_POST['delete']);

$tables = new Task02Tables();


?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Экзамены</h4>

        <?= $tables->toTableData($tables->getExams(), Exam::headerTable())?>
        
    </section>

<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Экзамены";
$activeTab = "task02Tables";

require_once "../../../Infrastructure/layout.php";       // layout страницы
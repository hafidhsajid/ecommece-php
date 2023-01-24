<?php
include('./database.php');
// var_dump($_GET['page']);
$halaman = $_GET['page'];

if ($halaman == null) {
  $halaman = 1;
}
$previous = $halaman - 1;
$next = $halaman + 1;
$limit = 6;
$select = "SELECT * FROM Barang";
if ($_GET['search'] != null) {
  $select .= " WHERE NamaBarang LIKE '%" . $_GET['search'] . "%'";
}


if ($_GET['page'] != null) {
  $select .= " LIMIT " . ($limit * ($_GET['page'] - 1)) . "," . $limit;
} else {
  $select .= " LIMIT " . $limit;
}
$result = $conn->query($select);
$jumlah_data = mysqli_fetch_array($conn->query("SELECT COUNT(*) total FROM `Barang`;"));
$jumlah_data = $jumlah_data['total'];
$total_halaman = $jumlah_data / $limit;
?>

</html>
<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  <script src="./tailwind.js"></script>
</head>

<body>
  <section class="search">

    <div id="header bg-grey-100 ">
      <div class="flex bg-grey-100 border-b border-gray-200 top-0 inset-x-0 z-100 h-16 items-center">
        <div class="w-full max-w-screen-xl relative mx-auto px-6">
          <div class="flex items-center -mx-6">

            <div class="flex flex-grow min-w-0 ">
              <div class="w-full min-w-0 ">
                <div class="relative">

                  <form action="index.php" method="get">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                    <div class="relative">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                      </div>
                      <input type="search" name="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 " placeholder="Search barang..." required>
                      <button type="submit" value="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="listitem">
    <div class="bg-gray-100">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-32">
          <h2 class="text-2xl font-bold text-gray-900">Barang</h2>
          <a href="insert.php">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
              Add
            </button>
          </a>



          <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-2">
            <?php
            if ($result->num_rows > 0) {
              while ($row = mysqli_fetch_array($result)) {
                // var_dump($row);
                // echo "<tr>";
                // echo "<td>" . $row['NamaBarang'] . "</td>";
                // echo "<td>" . $row['FotoBarang'] . "</td>";
                // echo "<td>" . $row['last_name'] . "</td>";
                // echo "<td>" . $row['email'] . "</td>";
                // echo "</tr>";
                // echo '<div class="group relative">';
                // echo '<div class="relative h-80 w-full overflow-hidden rounded-lg bg-white group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">';
                // echo '<img src="uploads/' . $row['FotoBarang'] . '" alt="' . $row['NamaBarang'] . '" class="h-full w-full object-cover object-center">';
                // echo '</div>';
                // echo '<h3 class="mt-6 text-sm text-gray-500">';
                // echo '<a href="#">';
                // echo '<span class="absolute inset-0"></span>';
                // echo $row['NamaBarang'];
                // echo '</a>';
                // echo '</h3>';
                // echo '<p class="text-base font-bold text-red-500"> ' . $row['Stok'] . ' left </p>';
                // echo '<p class="text-base font-bold text-gray-900"> Rp. ' . $row['HargaJual'] . '</p>';
                // echo '</div>';

                echo '<div class="flex justify-center">';
                echo '<div class="rounded-lg shadow-lg bg-white max-w-sm">';
                echo '<a href="#!">';
                echo '<div class="relative h-100 w-full overflow-hidden rounded-lg bg-white group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1"><img class="object-cover object-center rounded-t-lg" src="uploads/' . $row['FotoBarang'] . '" alt=""/>';
                echo '</div></a>';
                echo '<div class="p-6">';
                echo '<h5 class="text-gray-900 text-xl font-medium mb-2">' . $row['NamaBarang'] . '</h5>';
                echo '<p class="text-gray-700 text-base mb-4">';
                echo ' Rp. ' . $row['HargaJual'];
                echo '</p>';


                echo '<p class=" inline-block px-2 py-2.5 text-red-500 text-right font-bold text-xs leading-tight rounded ">' . $row['Stok'] . ' left</p>';
                echo '<form action="edit.php" method="post"><input type="hidden" name="id" value="' . $row['Id'] . '"><div class="flex justify-between"><button type="submit" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Edit</button> </form>
      <button type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" onclick="hapuss(' . $row['Id'] . ')">Delete</button> </div>';


                echo '</div>';
                echo '</div>';
                echo '</div>';
              }
            }
            ?>

          </div>
        </div>
      </div>
    </div>
    <!-- pagination -->
    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
      <div class="flex flex-1 justify-between sm:hidden">
        <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
        <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
      </div>
      <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
          <p class="text-sm text-gray-700">
            Showing
            <span class="font-medium"><?= $halaman ?></span>
            to
            <span class="font-medium"><?= ceil($total_halaman) ?></span>
            of
            <span class="font-medium"><?= $jumlah_data ?></span>
            results
          </p>
        </div>
        <div>
          <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
            <?php
            ?>
            <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
            <?php
            // echo $total_halaman;
            if ($total_halaman < 10) {

              if ($halaman - 1 > 0) {

                echo  !is_null($_GET['search']) ? '<a href="?page=' . ($halaman - 1) . '&search=' . ($_GET['search']) . '" class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">' : '<a href="?page=' . ($halaman - 1) . '" class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">';
                echo '<span class="sr-only">Previous</span>';
                echo '<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
                echo '<path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />';
                echo '</svg>';
                echo '</a>';
              }
              for ($i = 0; $i < $total_halaman; $i++) {


                if ($halaman - 1 == $i) {
                  echo  !is_null($_GET['search']) ? '<a href="?page=' . ($i + 1) . '&search=' . ($_GET['search']) .  '" class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20" aria-current="page">' . ($i + 1) . '</a>' : '<a href="?page=' . ($i + 1) . '" class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20" aria-current="page">' . ($i + 1) . '</a>';
                } else {
                  echo !is_null($_GET['search']) ? '<a href="?page=' . ($i + 1) . '&search=' . ($_GET['search']) .  '" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">' . ($i + 1) . '</a>' : '<a href="?page=' . ($i + 1) . '" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">' . ($i + 1) . '</a>';
                }
              }
              if ($result->num_rows < $limit) {
                echo '<a class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">';
              } else {
                echo !is_null($_GET['search']) ? ('<a href="?page=' . ($halaman + 1) . '&search=' . ($_GET['search']) . '" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">') : '<a href="?page=' . ($halaman + 1) . '" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">';
              };
            } else {

              if ($halaman - 1 > 0) {

                echo '<a href="?page=' . ($halaman - 1) . '" class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">';
                echo '<span class="sr-only">Previous</span>';
                echo '<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
                echo '<path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />';
                echo '</svg>';
                echo '</a>';
              }
              if ($halaman == 1) {
                echo '<a href="?page=' . (1) . '" class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20" aria-current="page">' . (1) . ' </a>';
              } else {

                echo '<a href="?page=1" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">1</a>';
              }
              if ($halaman == 2) {
                echo '<a href="?page=' . (2) . '" class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20" aria-current="page">' . (2) . ' </a>';
              } else {

                echo '<a href="?page=2" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">2</a>';
              }
              if ($halaman == 3) {
                echo '<a href="?page=' . (3) . '" class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20" aria-current="page">' . (3) . ' </a>';
              } else {

                echo '<a href="?page=3" class="relative hidden items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20 md:inline-flex">3</a>';
              }
              echo '<span class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700">...</span>';
              if ($halaman > 3 && $halaman < $total_halaman - 2) {
                echo '<a href="?page=' . ($halaman) . '" aria-current="page" class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20">' . ($halaman) . '</a>';
                echo '<span class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700">...</span>';
              }
              if ($halaman == $total_halaman - 2) {
                echo '<a href="?page=' . ($total_halaman - 2) . '" class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20" aria-current="page">' . ($total_halaman - 2) . ' </a>';
              } else {

                echo '<a href="?page=' . ($total_halaman - 2) . '" class="relative hidden items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20 md:inline-flex">' . ($total_halaman - 2) . '</a>';
              }
              if ($halaman == $total_halaman - 1) {
                echo '<a href="?page=' . ($total_halaman) . '" class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20" aria-current="page">' . ($total_halaman - 1) . ' </a>';
              } else {

                echo '<a href="?page=' . ($total_halaman - 1) . '" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">' . ($total_halaman - 1) . '</a>';
              }
              if ($halaman == $total_halaman) {
                echo '<a href="?page=' . ($total_halaman) . '" class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20" aria-current="page">' . ($total_halaman) . ' </a>';
              } else {

                echo '<a href="?page=' . $total_halaman . '" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">' . ($total_halaman) . '</a>';
              }

              if ($result->num_rows < $limit) {
                echo '<a class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">';
              } else {
                echo '<a href="?page=' . ($halaman + 1) . '" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">';
              };
            }
            ?>
            <span class="sr-only">Next</span>
            <!-- Heroicon name: mini/chevron-right -->
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
            </svg>
            </a>
          </nav>
        </div>
      </div>
    </div>
  </section>



  <!-- <div class="flex items-center justify-center h-full"> -->
  <!-- <button class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700" onclick="toggleModal1()">Show Modal</button> -->
  <!-- </div> -->
  <!-- Modal toggle -->
  <!-- <button data-modal-target="default" onclick="toggleModal()" data-modal-toggle="modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"> -->
  <!-- Toggle modal -->
  <!-- </button> -->

  <!-- Main modal -->
  <div id="modal" tabindex="-1" aria-hidden="true" class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            Terms of Service
          </h3>
          <button type="button" onclick="toggleModal()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="p-6 space-y-6">
          <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
            With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
          </p>
          <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
            The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
          </p>
        </div>
        <!-- Modal footer -->
        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
          <button data-modal-hide="modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
          <button data-modal-hide="modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modal1" tabindex="-1" aria-labelledby="exampleModalScrollableLabel" aria-hidden="true">
    <!-- <div class="modal-dialog modal-dialog-scrollable relative w-auto pointer-events-none">
    < -->
    <!-- <div class="fixed z-10 overflow-auto hover:overflow-scroll top-0 w-full left-0 hidden" id="modal1"> -->
    <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-900 opacity-75" />
      </div>
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
      <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        <!-- <div class="modal-dialog modal-dialog-scrollable relative w-auto pointer-events-none"> -->
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <label>Name</label>
          <input type="text" class="w-full bg-gray-100 p-2 mt-2 mb-3" />
          <label>Name</label>
          <input type="text" class="w-full bg-gray-100 p-2 mt-2 mb-3" />
          <label>Name</label>
          <input type="text" class="w-full bg-gray-100 p-2 mt-2 mb-3" />
          <label>Name</label>
          <input type="text" class="w-full bg-gray-100 p-2 mt-2 mb-3" />
          <label>Name</label>
          <input type="text" class="w-full bg-gray-100 p-2 mt-2 mb-3" />
          <label>Name</label>
          <input type="text" class="w-full bg-gray-100 p-2 mt-2 mb-3" />
          <label>Name</label>
          <input type="text" class="w-full bg-gray-100 p-2 mt-2 mb-3" />
          <label>Name</label>
          <input type="text" class="w-full bg-gray-100 p-2 mt-2 mb-3" />
          <label>Name</label>
          <input type="text" class="w-full bg-gray-100 p-2 mt-2 mb-3" />
          <label>Name</label>
          <input type="text" class="w-full bg-gray-100 p-2 mt-2 mb-3" />
          <label>Name</label>
          <input type="text" class="w-full bg-gray-100 p-2 mt-2 mb-3" />
          <label>Url</label>
          <input type="text" class="w-full bg-gray-100 p-2 mt-2 mb-3" />
        </div>
        <div class="bg-gray-200 px-4 py-3 text-right">
          <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2" onclick="toggleModal1()"><i class="fas fa-times"></i> Cancel</button>
          <button type="button" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 mr-2"><i class="fas fa-plus"></i> Create</button>
        </div>
      </div>
    </div>
  </div>


</body>
<script>
  // function toggleModal() {
  //   document.getElementById('modal').classList.toggle('hidden')
  // }

  // function toggleModal1() {
  //   document.getElementById('modal1').classList.toggle('hidden')
  // }

  function hapuss(id) {
    Swal.fire({
      title: 'Do you want to delete?',
      showDenyButton: true,
      showCancelButton: true,

      showConfirmButton: false,
      denyButtonText: 'Delete',
      cancelButtonText: `Cancel`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isDenied) {
        fetch('delete.php', {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              "id": 78912 + id
            })
          })
          .then(function(response) {
            if (response.status !== 200) {
              console.log(response.status)
              // alert("SERVER ERRROR")
              Swal.fire('Changes are not delete', '', 'error')
            } else {
              Swal.fire('Deleted!', '', 'success')
                .then(function() {
                  window.location = "/"
                })
            }
          })
      } else {
        Swal.fire('Changes are not delete', '', 'error')
      }
    })
    // if (confirm('Apakah anda yakin untuk menghapus?') == true) {
    //   // console.log(id);
    //   fetch('delete.php', {
    //       method: 'POST',
    //       headers: {
    //         'Accept': 'application/json',
    //         'Content-Type': 'application/json'
    //       },
    //       body: JSON.stringify({
    //         "id": 78912 + id
    //       })
    //     })
    //     .then(function(response) {
    //       if (response.status !== 200) {
    //         console.log(response.status)
    //         alert("SERVER ERRROR")

    //       } else {
    //         window.location = "/";

    //       }
    //     })
    // }

  }
</script>

</html>
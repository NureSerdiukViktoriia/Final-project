<?php
namespace Views;
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
require_once __DIR__ . '/../controllers/page.php';
use Controllers\Page;
$page = new Page();
$page->Header();

?>

<main>
<div class="text-pictures-section">
        <div class="texth">
          <h2>Why should you choose our travel agency?</h2>
        </div>
        <div class="text-pictures-sectionol">
          <ol>
            <div class="text-pictures-sectionolimg1">
              <section class="text-pictures-sectionolimg1li">
                <li class="text-pictures-sectionolimg1li1">
                  1. We provide a wide range of services:
                </li>
                <ul>
                  <div class="text-pictures-sectionolimg1ulli">
                    <li>- booking hotels and air tickets;</li>
                    <li>- organization of excursions and tours;</li>
                    <li>- obtaining visas and paperwork;</li>
                    <li>- transfers and car rental;</li>
                    <li>- and much more.</li>
                  </div>
                </ul>
              </section>
              <section class="text-pictures-sectionol-img1">
                <img
                  class="text-pictures-sectionol-img1src"
                  src="../img/062249.jpg"
                  alt=""
                />
              </section>
            </div>

            <div class="text-pictures-sectionolimg1">
              <section class="text-pictures-sectionol-img1">
                <img
                  class="text-pictures-sectionol-img1src"
                  src="../img/7321.jpg"
                  alt=""
                />
              </section>
              <section class="text-pictures-sectionolimg1li">
                <li class="text-pictures-sectionolimg1li1">
                  2. We have rich experience in the tourism industry:
                </li>
                <ul>
                  <div class="text-pictures-sectionolimg2ulli">
                    <li>- our company was founded over 10 years ago;</li>
                    <li>
                      - during this time we have successfully organized
                      thousands of trips around the world;
                    </li>
                    <li>
                      - we work only with trusted partners and service
                      providers.
                    </li>
                  </div>
                </ul>
              </section>
            </div>

            <div class="text-pictures-sectionolimg1">
              <section class="text-pictures-sectionolimg1li">
                <li class="text-pictures-sectionolimg1li1">
                  3. We value the comfort and safety of our customers:
                </li>
                <ul>
                  <div class="text-pictures-sectionolimg3ulli">
                    <li>
                      - we will select the best accommodation and flight
                      conditions for you;
                    </li>
                    <li>
                      - our tours always have insurance that covers any
                      unforeseen situations;
                    </li>
                    <li>
                      - we work around the clock to help you with any questions
                      and concerns.
                    </li>
                  </div>
                </ul>
              </section>
              <section class="text-pictures-sectionol-img1">
                <img
                  class="text-pictures-sectionol-img1src"
                  src="../img/574181.jpg"
                  alt=""
                />
              </section>
            </div>

            <div class="text-pictures-sectionolimg1">
              <section class="text-pictures-sectionol-img1">
                <img
                  class="text-pictures-sectionol-img1src"
                  src="../img/9881.jpg"
                  alt=""
                />
              </section>
              <section class="text-pictures-sectionolimg1li">
                <li class="text-pictures-sectionolimg1li1">
                  4. We provide a flexible system of discounts and bonuses:
                </li>
                <ul>
                  <div class="text-pictures-sectionolimg4ulli">
                    <li>
                      - we have regular promotions and special offers for our
                      customers;
                    </li>
                    <li>
                      - we provide discounts when ordering several services at
                      the same time;
                    </li>
                    <li>
                      - we have a loyalty program that allows you to accumulate
                      bonuses and exchange them for free services.
                    </li>
                  </div>
                </ul>
              </section>
            </div>
          </ol>
        </div>
      </div>
</main>
<!-- 
<section>
    <form action="" method="post">
        <textarea name="info" placeholder="Enter information..." required></textarea><br>
        <button type="submit">Submit</button>
    </form>
</section> -->

<?php 
  

$page->Footer();
?>
</body>
</html>
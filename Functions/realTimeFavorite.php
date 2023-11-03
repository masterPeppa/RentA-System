<?php
session_start();
include ("../DataBase/connection.php");
$favorite_user_id = $_POST['favId'];

                    $select_favorites = "SELECT * FROM user_favorites WHERE user_id='$favorite_user_id'";
                    $execute_favorites = mysqli_query($con, $select_favorites);
                    $favorites_row_count = mysqli_fetch_all($execute_favorites, MYSQLI_ASSOC);
                if(count($favorites_row_count) > 0){
                         for($i = 0; $i < count($favorites_row_count); $i++){
                              $favorite_id_value = "{$favorites_row_count[$i]['favorite_id']}";
                              $select_favorites_value = "SELECT * FROM landing_properties WHERE propertyID='$favorite_id_value'";
                              $execute_favorites_value = mysqli_query($con, $select_favorites_value);
                              $favorites__value = mysqli_fetch_assoc($execute_favorites_value);

                              $imgfeatured1 = str_replace("../../", "", $favorites__value['imgFeatured1']);

                              echo "<div class='card card-property'>

                              <div id='carousel$i' class='carousel' data-bs-interval='false'>
                                  <div class='carousel-inner'>";
                          
                          if (!isset($_SESSION['rEmail']) && !isset($_SESSION['lEmail'])) {
                              echo "<button onclick=\"favoriteData('save$i','saved$i')\" class='heart-btns saveButton d-block' id='save$i' value='{$favorites__value['propertyID']}'><i class='bi bi-heart heart-icons'></i></button>";
                              echo "<button onclick=\"favoriteData('save$i','saved$i')\" class='heart-btns unsaveButton d-none' id='saved$i' value='unsave'><i class='bi bi-heart-fill heart-icons'></i></button>";
                          } else {
                              // Check if the user is a landlord
                              if (isset($_SESSION['lEmail'])) {
                                  if (count($favorites_row_count) > 0) {
                                      echo "<button onclick=\"favoriteData('save$i','saved$i')\" class='heart-btns saveButton d-none' id='save$i' value='{$favorites__value['propertyID']}'><i class='bi bi-heart heart-icons'></i></button>";
                                      echo "<button onclick=\"favoriteData('save$i','saved$i')\" class='heart-btns unsaveButton d-block' id='saved$i' value='unsave'><i class='bi bi-heart-fill heart-icons'></i></button>";
                                  } else {
                                      echo "<button onclick=\"favoriteData('save$i','saved$i')\" class='heart-btns saveButton d-block' id='save$i' value='{$favorites__value['propertyID']}'><i class='bi bi-heart heart-icons'></i></button>";
                                      echo "<button onclick=\"favoriteData('save$i','saved$i')\" class='heart-btns unsaveButton d-none' id='saved$i' value='unsave'><i class='bi bi-heart-fill heart-icons'></i></button>";
                                  }
                              }
                              // Check if the user is a renter
                              else if (isset($_SESSION['rEmail'])) {
                                  if (count($favorites_row_count) > 0) {
                                      echo "<button onclick=\"favoriteData('save$i','saved$i')\" class='heart-btns saveButton d-none' id='save$i' value='{$favorites__value['propertyID']}'><i class='bi bi-heart heart-icons'></i></button>";
                                      echo "<button onclick=\"favoriteData('save$i','saved$i')\" class='heart-btns unsaveButton d-block' id='saved$i' value='unsave'><i class='bi bi-heart-fill heart-icons'></i></button>";
                                  } else {
                                      echo "<button onclick=\"favoriteData('save$i','saved$i')\" class='heart-btns saveButton d-block' id='save$i' value='{$favorites__value['propertyID']}'><i class='bi bi-heart heart-icons'></i></button>";
                                      echo "<button onclick=\"favoriteData('save$i','saved$i')\" class='heart-btns unsaveButton d-none' id='saved$i' value='unsave'><i class='bi bi-heart-fill heart-icons'></i></button>";
                                  }
                              }
                          }
                          
                          echo "<div class='carousel-item active'>
                                      <img src='$imgfeatured1' class='d-block card-img' alt='...'>
                                  </div>
                              </div>
                          </div>
                          <!-- card body -->
                          <div class='card-body px-3 mt-3'>
                              <h5 class='card-title txts-bld ms-1'>{$favorites__value['propertyTitle']}</h5>
                              <div class='div-location d-flex mt-3'>
                                  <i class='bi bi-geo-alt-fill ms-1'></i>
                                  <p class='card-text mt-1'>&nbsp;{$favorites__value['propertyProvince']}, {$favorites__value['propertyCity']}</p>
                              </div>
                          
                              <div class='div-price d-flex align-items-center gap-2 mt-2'>
                                  <p class='card-price ms-1'>₱" . number_format($favorites__value['propertyPrice']) . "</p>
                                  <p class='card-per txts-bld'>{$favorites__value['propertyPayment']}</p>
                              </div>
                          
                              <div class='div-details d-flex mt-3 align-items-center gap-4 ps-1'>
                                  <div class='d-flex gap-2 align-items-center justify-content-center'>
                                      <img src='imgs/bedroomIcon.png' alt='Bedroom' class='card-icons bed-icon'>
                                      <span class='quantity'>{$favorites__value['propertyBedrooms']}</span>
                                  </div>
                          
                                  <div class='d-flex gap-2 align-items-center justify-content-center'>
                                      <img src='imgs/bathroomIcon.png' alt='Bathroom' class='card-icons'>
                                      <span class='quantity'>{$favorites__value['propertyBathroom']}</span>
                                  </div>
                          
                                  <div class='d-flex gap-2 align-items-center justify-content-center'>
                                      <img src='imgs/sqmIcon.png' alt='Floor Area' class='card-icons'>
                                      <span class='quantity'>{$favorites__value['propertyFloorArea']} <span> m<sup>2</sup></span> </span>
                                  </div>
                              </div>
                          
                              <div class='d-flex justify-content-center mt-3'>
                                  <a href='viewProperty.php?id={$favorites__value['propertyID']}' target='_blank' class='btn btn-view-property px-5 py-2'>View Property</a>
                              </div>
                          </div>
                          </div>";
                              }
                         }
                         else{
                            echo "<div class='review-ratings d-flex flex-column gap-3 ps-2 w-100'>
                                <h5 class='review-overall-rating'>No saved properties yet.</h5>

                                <a href='rentals.php' role='button' class='btn-explore w-75 mt-3 d-flex align-items-center justify-content-center gap-2'>
                                    <span><i class='bi bi-search-heart-fill'></i></span>
                                    <span class='txt-explore'>Explore RentA</span>
                                </a>
                            </div>";
                         }
                    ?>
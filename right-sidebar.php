<div class="right_sidebar">
            <div class="search-container">
                <a href="" class="search-btn">
                    <i class="fa fa-search"></i>
                </a>
                <input type="text" name="search" placeholder="search" class="search-input search" autocomplete="off">
            </div>
            <div class='search-result'>
            </div>
            
            <?php $getFromT->trends();?>
            
            <?php $getFromF->whoToFollow( $user_id, $user_id );?>
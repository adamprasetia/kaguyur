<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
        <div class="breadcumb">
            <ul>
                <li><a href="<?php echo base_url() ?>">Home</a></li>
                <li><a href="<?php echo base_url('artikel') ?>">Artikel</a></li>
            </ul>
        </div>
        <form method="get" id="form_data_pencarian" action="<?php echo base_url('artikel'); ?>">
        <div class="mb-3">
            <input class="field w-full" type="text" name="search" id="search" placeholder="Pencarian..." value="<?php echo htmlentities($this->input->get('search',true)) ?>"/>
        </div>
        </form>
        <script>
        // Get the input field
        var input = document.getElementById("search");

        // Execute a function when the user releases a key on the keyboard
        input.addEventListener("keyup", function(event) {
            // Number 13 is the "Enter" key on the keyboard
            if (event.keyCode === 13) {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            // document.getElementById("myBtn").click();
            document.getElementById("form_data_pencarian").submit();
            }
        });
        </script>

        <?php $this->load->view('content/artikel_gate_view') ?>

        <div class="grid grid-cols-6 gap-10">
            <div class="col-span-6 md:col-span-3">
                <div class="mt-5">
                    <ul>
                        <?php foreach ($article as $row) { ?>                            
                        <li class="grid grid-cols-8 gap-4 mb-5">
                            <?php if (!empty($row->image)) { ?>                                
                            <div class="col-span-3 md:col-span-2">
                                <img class="imgfillImg" src="<?php echo gen_thumb($row->image,'300x300') ?>" alt="" />
                            </div>
                            <?php } ?>
                            <div class="col-span-5 md:col-span-6">
                                <a href="<?php echo base_url('artikel/'.$row->id.'/'.url_title($row->title,'-',true))?>">
                                    <h4 class="mb-2 text__wrap2"><?php echo $row->title ?></h4>
                                    <p class="text-sm text__wrap3"><?php echo $row->description ?></p>
                                    <p class="text-sm text__wrap3"><?php echo format_dmy($row->published_date) ?></p>
                                </a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="paging">
          <?php echo $paging ?>      
        </div>
    </div>
</div>
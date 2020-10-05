
                <?php
                if ($order_form->template_style == 'flipbox') {
                ?>
                    <?php
                    foreach ($packages as $i => $package) {
                        $sold_out = $this->Html->ifSet($package->qty, null) == '0';
                        $limit_reached = $package->client_qty !== null && $package->client_qty <=  $this->Html->ifSet($package_counts[$package->id], 0);
                        $lowest_price = null;

                        // Select the first non sold out package
                        if (!$sold_out && !$this->Html->ifSet($package_id) && !$this->Html->ifSet($pricing_id)) {
                            $package_id = $package->id;
                        }

                        if (!$sold_out
                            && !$limit_reached
                            && !$this->Html->ifSet($package_id)
                            && !$this->Html->ifSet($pricing_id)
                        ) {
                            $package_id = $package->id;
                        }

                        $selected_pricing_id = null;
                        foreach ($package->pricing as $price) {
                            if ($this->Html->ifSet($pricing_id) == $price->id) {
                                $package_id = $package->id;
                                $selected_pricing_id = $pricing_id;
                            }

                            if ($lowest_price === null || $lowest_price->price > $price->price) {
                                $lowest_price = $price;
                            }
                        }
                    ?>
                    <div class="col-md-4 package-boxes card-container text-center">
                        <?php
                        // Prevent sold out packages from being submitted
                        if ($sold_out || $limit_reached) {
                        ?>
                            <div class="package card-flip">
                        <?php
                        } else {
                        ?>
                            <div class="package card-flip <?php echo ($this->Html->ifSet($package_id) == $package->id ? 'selected' : '');?>" data-group-id="<?php $this->Html->_($package_group->id);?>" data-pricing-id="<?php $this->Html->_($lowest_price->id);?>" data-selected-pricing-id="<?php $this->Html->_($selected_pricing_id);?>">
                        <?php
                        }
                        ?>

                            <div class="card front">
                            <div class="package-name panel-heading">
                                <h4><?php $this->Html->_($package->name);?></h4>
                            </div>
                            <div class="price-box">
                                <p><?php $this->_('Main.packages.price_start');?></p>
                                <h4><?php echo $this->CurrencyFormat->format($this->Html->ifSet($lowest_price->price), $this->Html->ifSet($lowest_price->currency));?></h4>
                            </div>
                            
                            </div><!--card front-->
                            <div class="card back">
                            <div class="package-name panel-heading">
                                <h4><?php $this->Html->_($package->name);?></h4>
                            </div>
                            <div class="price-box">
                                <p><?php $this->_('Main.packages.price_start');?></p>
                                <h4><?php echo $this->CurrencyFormat->format($this->Html->ifSet($lowest_price->price), $this->Html->ifSet($lowest_price->currency));?></h4>
                            </div>
                            <?php
                            if (!empty($package->description_html) || !empty($package->description)) {
                            ?>
                                <?php echo ($this->Html->ifSet($package->description_html) != '' ? $package->description_html : $this->TextParser->encode($parser_syntax, $package->description));?>
                            <?php
                            }

                            if ($sold_out) {
                            ?>
                            <div class="order sold-btn">
                                <div disabled="disabled" class="btn btn-danger btn-lg btn-block"><?php $this->_('Main.packages.box_sold_out');?></div>
                            </div>
                            <?php
                            } elseif ($limit_reached) {
                            ?>
                            <div class="order sold-btn">
                                <div disabled="disabled" class="btn btn-danger btn-lg btn-block"><?php $this->_('Main.packages.box_client_limit');?></div>
                            </div>
                            <?php
                            } else {
                            ?>
                            <!--div class="order selected-btn">
                                <button type="button" class="btn btn-success btn-lg btn-block"><?php // $this->_('Main.packages.box_selected');?></button>
                            </div-->
                            <div class="order unselected-btn">
                                <button type="button" class="btn btn-outline-success btn-sm btn-block"><?php $this->_('Main.packages.box_select');?></button>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        </div>
                        </div><!--card back-->
                    </div>
                    <?php
                    }
                    ?>
                <?php
                } elseif ($order_form->template_style == 'slider') {
                echo 'Slider Theme';
                }
                ?>
    

test
<style>
.card-container {
    perspective: 700px;
}

.card-flip, .card-container {
    transform-style: preserve-3d;
    transition: all 0.7s ease;
}

.card-flip div {
    backface-visibility: hidden;
    transform-style: preserve-3d;
}

.back {
    transform: rotateY(-180deg);
}

.card-container:hover .card-flip {
    transform: rotateY(180deg);
}
  .card-flip {
    display: grid; grid-template: 1fr / 1fr;
    grid-template-areas: "frontAndBack";
    transform-style: preserve-3d;
    transition: all 0.7s ease;
}

.front {
    grid-area: frontAndBack;
}

.back {
    grid-area: frontAndBack;
    transform: rotateY(-180deg);
}

                <div class="navfix"></div>
                <div class="col-md-10">
                    <div class="section-title">
                        <h3><?php $this->Html->_($package_group->name);?></h3>
                        <?php
                        if (empty($package_group->description)) {
                        ?>
                        <p class="format"><?php $this->_('Main.packages.subheading');?></p>
                        <?php
                        } else {
                            echo $this->TextParser->encode($parser_syntax, $package_group->description);
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-2">
                    <?php
                    if (count($this->Html->ifSet($order_form->currencies, [])) > 1) {
                    ?>
                    <div class="currency">

                        <?php
                        $this->Form->setCsrfOptions(['set_on_create' => false]);
                        $this->Form->create(null, ['method' => 'GET', 'class' => 'form-inline']);
                        $this->Form->fieldHidden('group_id', $this->Html->ifSet($package_group->id));
                        ?>
                            <label for="change_currency">
                                <?php $this->_('Main.index.field_currency');?>
                            </label>
                            <?php
                            $this->Form->fieldSelect('currency', $this->Form->collapseObjectArray($order_form->currencies, 'currency', 'currency'), $this->Html->ifSet($currency), ['class' => 'form-control input-sm', 'id' => 'change_currency']);
                            ?>
                        <?php
                        $this->Form->end();
                        $this->Form->setCsrfOptions(['set_on_create' => true]);
                        ?>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="clearfix"></div>

                <?php
                if ($order_form->template_style == 'list') {
                ?>
                    <?php
                    foreach ($packages as $i => $package) {
                        $sold_out = $this->Html->ifSet($package->qty, null) == '0';
                        $limit_reached = $package->client_qty !== null && $package->client_qty <= $this->Html->ifSet($package_counts[$package->id], 0);
                        $lowest_price = null;
                        if (!$sold_out && !$this->Html->ifSet($package_id)  && !$this->Html->ifSet($pricing_id)) {
                            $package_id = $package->id;
                        }

                        $selected_pricing_id = null;
                        foreach ($package->pricing as $price) {
                            if ($this->Html->ifSet($pricing_id) == $price->id) {
                                $package_id = $package->id;
                                $selected_pricing_id = $pricing_id;
                            }

                            if ($lowest_price === null || $lowest_price->price > $price->price)
                                $lowest_price = $price;
                        }

                        // Prevent sold out packages from being submitted
                        if ($sold_out || $limit_reached) {
                        ?>
                            <div class="well well-order package-list">
                        <?php
                        } else {
                        ?>
                            <div class="well well-order package-list <?php echo ($this->Html->ifSet($package_id) == $package->id ? 'selected' : '');?>" data-group-id="<?php $this->Html->_($package_group->id);?>" data-pricing-id="<?php $this->Html->_($lowest_price->id);?>" data-selected-pricing-id="<?php $this->Html->_($selected_pricing_id);?>">
                        <?php
                        }
                        ?>

                            <div class="col-md-4 col-sm-6 col-xs-12 package-item">
                                <h3><?php $this->Html->_($package->name);?></h3>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 package-description">
                                <?php
                                if (!empty($package->description_html) || !empty($package->description)) {
                                ?>
                                    <?php echo ($this->Html->ifSet($package->description_html) != '' ? $package->description_html : $this->TextParser->encode($parser_syntax, $package->description));?>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 package-item">
                                <h3 class="pull-right"><small><?php $this->_('Main.packages.price_start');?></small> <?php echo $this->CurrencyFormat->format($this->Html->ifSet($lowest_price->price), $this->Html->ifSet($lowest_price->currency));?></h3>
                                <div class="clearfix"></div>
                                <div>
                                    <?php
                                    if ($sold_out) {
                                    ?>
                                    <div class="order sold-btn">
                                        <div disabled="disabled" class="btn btn-danger btn-lg pull-right"><?php $this->_('Main.packages.box_sold_out');?></div>
                                    </div>
                                    <?php
                                    } elseif ($limit_reached) {
                                    ?>
                                    <div class="order sold-btn">
                                        <div disabled="disabled" class="btn btn-danger btn-lg pull-right"><?php $this->_('Main.packages.box_client_limit');?></div>
                                    </div>
                                    <?php
                                    } else {
                                    ?>
                                    <div class="order selected-btn">
                                        <button type="button" class="btn btn-success btn-lg pull-right"><?php $this->_('Main.packages.box_selected');?></button>
                                    </div>
                                    <div class="order unselected-btn">
                                        <button type="button" class="btn btn-default btn-lg pull-right"><?php $this->_('Main.packages.box_select');?></button>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php
                    }
                    ?>
                <?php
                } elseif ($order_form->template_style == 'boxes') {
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
                ?>
                    <div class="well well-order package-slider">
                        <?php
                        $slider_packages = [];
                        $slider_packages_js = [];
                        foreach ($packages as $i => $package) {
                            if ($i == 0 && !$this->Html->ifSet($package_id) && !$this->Html->ifSet($pricing_id)) {
                                $package_id = $package->id;
                            }
                            $lowest_price = null;
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
                            $slider_packages[$package->id] = (object)['index' => $i+1, 'group_id' => $package_group->id, 'pricing_id' => $this->Html->ifSet($lowest_price->id)];
                            $slider_packages_js[$slider_packages[$package->id]->index] = $slider_packages[$package->id];
                        }
                        $this->Form->fieldText(null, $this->Html->ifSet($slider_packages[$this->Html->ifSet($package_id)]->index), ['id' => 'package_slider', 'data-slider-min' => 1, 'data-slider-max' => count($this->Html->ifSet($packages, [])), 'data-slider-step' => 1, 'data-slider-value'=> $this->Html->ifSet($slider_packages[$this->Html->ifSet($package_id)]->index)]);
                        ?>
                        <div class="instructions"><i class="fa fa-share fa-rotate-270"></i> <?php $this->_('Main.packages.select_note');?></div>

                        <?php
                        foreach ($packages as $i => $package) {
                            $lowest_price = null;
                            foreach ($package->pricing as $price) {
                                if ($lowest_price === null || $lowest_price->price > $price->price) {
                                    $lowest_price = $price;
                                }
                            }
                        ?>
                        <div id="package_<?php echo $this->Html->safe($i+1);?>" class="package-block <?php echo ($this->Html->ifSet($package_id) == $package->id ? 'active' : '');?>">
                            <div class="col-md-6 package-selected">
                                <h3><?php $this->Html->_($package->name);?></h3>
                            </div>
                            <div class="col-md-6 package-selected">
                                <h3 class="pull-right"><small><?php $this->_('Main.packages.price_start');?></small> <?php echo $this->CurrencyFormat->format($this->Html->ifSet($lowest_price->price), $this->Html->ifSet($lowest_price->currency));?></h3>
                            </div>
                            <div class="clearfix"></div>
                            <?php
                            if (!empty($package->description_html) || !empty($package->description)) {
                            ?>
                                <hr>
                                <div class="package-description">
                                    <?php echo ($this->Html->ifSet($package->description_html) != '' ? $package->description_html : $this->TextParser->encode($parser_syntax, $package->description));?>
                                </div>
                                <div class="clearfix"></div>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
                ?>

                <div class="clearfix"></div>
                <hr>

                <div class="col-md-6" id="package-config"></div>
                <div class="col-md-6" id="order-summary"></div>
                <div class="col-md-12 noindent" id="create-account"></div>

    <script type="text/javascript">
        var base_uri = '<?php $this->Html->_($this->base_uri);?>';
        var order_label = '<?php $this->Html->_($order_form->label);?>';
    </script>
    <script type="text/javascript" src="<?php echo $this->Html->safe($this->view_dir . 'javascript/order.js');?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize package selection
            initPackages(
                <?php echo json_encode($this->Html->ifSet($slider_packages_js, []));?>,
                <?php echo json_encode($this->Html->ifSet($config_options, []));?>
            );

            <?php if ($order_form->template_style == 'slider') { ?>
            // Fetch initial configuration
            fetchConfig('<?php $this->Html->_($slider_packages[$this->Html->ifSet($package_id)]->group_id);?>',
                '<?php echo $this->Html->ifSet($pricing_id, $slider_packages[$this->Html->ifSet($package_id)]->pricing_id);?>',
                null,
                <?php echo json_encode($this->Html->ifSet($config_options, []));?>
            );
            <?php } ?>

            // Fetch signup/login
            fetchSignup();
        });

        // Process change currency request
        $("#change_currency").change(function() {
            $(this).closest("form").attr('action', window.location.href);
            $(this).closest("form").submit();
        });

    </script>

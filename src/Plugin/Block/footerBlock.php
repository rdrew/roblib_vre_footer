<?php

namespace Drupal\roblib_vre_footer\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'footerBlock' block.
 *
 * @Block(
 *  id = "footer_block",
 *  admin_label = @Translation("Footer block"),
 * )
 */
class footerBlock extends BlockBase {


    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
        return [
            'main_footer_menu' => '
            <section class="upei_vre_footer vre-footer-menus">
            <div class="vre-footer-menu">
            <h4 class="title">Getting Started</h4>
            <ul class="links">
            <li><a href="http://www.upei.ca/research">Research at UPEI</a></li>
            <li><a href="http://www.upei.ca/research/research-services">Research Services</a></li>
            <li><a href="http://www.upei.ca/research/notices">Research Notices</a></li>
            <li><a href="http://www.upei.ca/research/research-staff">Research Contacts</a></li>
            </ul>
            </div>

            <div class="vre-footer-menu">
            <h4 class="title">Funding &amp; Supports<a href="http://www.upei.ca/research" title="">​</a></h4>
            <ul class="links">
            <li class="leaf"><a href="http://www.upei.ca/research/research-services/find-researcher" title="">Find a Researcher</a></li>
            <li class="leaf"><a href="http://www.upei.ca/research/forms" title="">Research Forms</a></li>
            <li class="leaf"><a href="http://www.nserc-crsng.gc.ca/International-Internationale/Index_eng.asp">NSERC</a>&nbsp;<a href=".">/</a>&nbsp;<a href="http://www.cihr-irsc.gc.ca/e/27171.html">CIHR</a>&nbsp;<a href=".">/</a>&nbsp;<a href="http://www.sshrc-crsh.gc.ca/funding-financement/index-eng.aspx">SSHRC</a></li>
            <li class="leaf"><a href="http://www.genomecanada.ca/">Genome Canada</a>&nbsp;<a href=".">/</a>&nbsp;<a href="http://www.innovation.ca/">CFI</a></li>
            </ul>
            </div>

            <div class="vre-footer-menu">
            <h4 class="title">Managing Research</h4>
            <ul class="links">
            <li class="leaf"><a href="http://library.upei.ca/vre">Virtual Research Environments</a>&nbsp;</li>
            <li class="leaf"><a href="http://library.upei.ca/vre/data">Data Management Planning</a></li>
            <li class="leaf"><a href="http://www.upei.ca/itss/">ITSS</a> <a href=".">/</a> <a href="http://library.upei.ca">Library</a>&nbsp;</li>
            </ul>
            </div>

            <div class="vre-footer-menu">
            <h4 class="title">Sharing Research</h4>
            <ul class="links">
            <li class="leaf first"><a href="http://islandscholar.ca">IslandScholar.ca</a></li>
            <li class="leaf first"><a href="http://files.upei.ca/research/upei_open_access_policy.pdf">UPEI Open Access Policy</a></li>
            <li class="leaf first"><a href="http://www.carl-abrc.ca/en/scholarly-communications/resources-for-authors.html">CARL Author Resources</a></li>
            <li class="leaf first"><a href="http://www.openoasis.org/">OASIS SourceBook</a></li>
            </ul>
            </div>

            <div class="vre-footer-menu">
            <h4 class="title">Domain Resources</h4>
            <ul class="links">
            <li class="leaf first"><a href="http://www.npdi-us.org">NPDI</a></li>
            <li class="leaf"><a href="http://www.pharmacognosy.us/pharmacognosy-links/natural-products-news/">ASP Natural Products News</a></li>
            </ul>
            </div>
            </section>',

            'subfooter_menu' => '
            <section class="upei_vre_footer vre-subfooter">
            <div class="vre-subfooter__left">
            <div class="upei-address"><a href="www.library.upei.ca">This Virtual Research Environment (VRE) is hosted by the Robertson Library.</a></div>
            <ul class="upei-links">
            <li><a href="http://www.upei.ca/policy/gov/brd/gnl/0017">Privacy Policy</a> </li>
            <li><a href="http://home.upei.ca/disclaimer">Disclaimer</a> </li>
            <li><a href="mailto:roblib@upei.ca">Contact</a></li>
            </ul>
            </div>
            <div class="vre-subfooter__right">
            <ul class="logos">

            <li class="upei-logo"><img src="//files.upei.ca/misc/shieldfooter.png"></li>
            </ul>
            </div>
            </section>',
        ] + parent::defaultConfiguration();

    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $form['main_footer_menu'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Main Footer Menu'),
            '#description' => $this->t(''),
            '#default_value' => $this->configuration['main_footer_menu'],
            '#weight' => '0',
        ];
        $form['subfooter_menu'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Subfooter Menu'),
            '#description' => $this->t(''),
            '#default_value' => $this->configuration['subfooter_menu'],
            '#weight' => '0',
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        $this->configuration['main_footer_menu'] = $form_state->getValue('main_footer_menu');
        $this->configuration['subfooter_menu'] = $form_state->getValue('subfooter_menu');
    }

    /**
     * {@inheritdoc}
     */
    public function build() {
        $build = [];
        $build['footer_block_main_footer_menu']['#markup'] = $this->configuration['main_footer_menu'];
        $build['footer_block_subfooter_menu']['#markup'] = $this->configuration['subfooter_menu'];
        $build['footer_block']['#attached']['library'][] = 'roblib_vre_footer/roblib_vre_footer';

        return $build;
    }

    }

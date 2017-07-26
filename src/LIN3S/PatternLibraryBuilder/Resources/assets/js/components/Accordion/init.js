/*
 * This file is part of the Pattern Library Builder library.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Mikel Tuesta <mikeltuesta@gmail.com>
 */

import {onDomReady} from 'lin3s-event-bus';
import Accordion from './Accordion';

const initAccordions = () => {
  const
    accordions = document.querySelectorAll('.js-accordion');

  accordions.forEach(accordion => new Accordion(
    accordion, {
      itemSelector: 'plb-accordion-item',
      itemOpenedClass: 'plb-accordion-item--opened',
      itemHeaderClassSelector: 'plb-accordion-item__header'
    }
  ));
};

onDomReady(initAccordions);

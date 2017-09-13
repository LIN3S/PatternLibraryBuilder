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
import Tabbed from './Tabbed';

const initTabbeds = () => {
  const
    tabbeds = document.querySelectorAll('.js-plb-tabbed');

  tabbeds.forEach(tabbed => new Tabbed(tabbed, 'plb-tabbed__nav-item', 'plb-tabbed__tab'));
};

onDomReady(initTabbeds);

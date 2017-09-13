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
import Finder from './Finder';

const initFinders = () => {
  const
    finders = document.querySelectorAll('.js-plb-finder');

  finders.forEach(finder => new Finder(finder, {
    inputClassName: 'plb-finder__input',
    subjectClassName: 'plb-finder__subject',
    invalidSubjectClassName: 'plb-finder__subject--hidden'
  }));
};

onDomReady(initFinders);

/*
 * This file is part of the Pattern Library Builder project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Mikel Tuesta <mikeltuesta@gmail.com>
 */

'use strict';

import {onDomReady} from 'lin3s-event-bus';
import Finder from './Finder';

const initFinders = () => {
  const
    finders = document.querySelectorAll('.js-finder');

  finders.forEach(finder => new Finder(finder, {
    inputClassName: 'finder__input',
    subjectClassName: 'finder__subject',
    invalidSubjectClassName: 'finder__subject--hidden'
  }));
};

onDomReady(initFinders);

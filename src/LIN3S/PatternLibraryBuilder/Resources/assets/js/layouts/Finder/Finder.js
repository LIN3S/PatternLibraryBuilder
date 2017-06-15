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

'use strict';

import $ from 'jquery';

import debounce from 'lodash.debounce';

class Finder {

  domNode;
  $input;
  $subjects;
  invalidSubjectClassName;

  cachedSubjectsFilterValues;

  constructor(domNode, {inputClassName, subjectClassName, invalidSubjectClassName} = {}) {
    const $domNode = $(domNode);
    this.$input = $domNode.find(`.${inputClassName}`);
    this.$subjects = $domNode.find(`.${subjectClassName}`);
    this.invalidSubjectClassName = invalidSubjectClassName;
    this.cachedSubjectsFilterValues = Array.from(this.$subjects).map(subject =>
      $(subject).data('finder').toLowerCase());
    this.debouncedFilter = debounce(() => {
      this.filter(this.$input.val());
    }, 500);

    this.bindListeners();
    this.$input.focus();
  }

  bindListeners() {
    this.$input.on('input', this.debouncedFilter.bind(this));
  }

  filter(stringToFilter) {
    const stringToFilterWords = stringToFilter.toLowerCase().split(' ');
    Array.from(this.$subjects).forEach((subject, index) => {
      const
        subjectFilterValue = this.cachedSubjectsFilterValues[index],
        isSubjectValid = stringToFilterWords.every(word => subjectFilterValue.includes(word));
      $(subject).toggleClass(this.invalidSubjectClassName, !isSubjectValid);
    });
  }
}

export default Finder;

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

import debounce from 'lodash.debounce';

class Finder {

  domNode;
  input;
  subjects;
  invalidSubjectClassName;

  cachedSubjectsFilterValues;

  constructor(domNode, {inputClassName, subjectClassName, invalidSubjectClassName} = {}) {
    this.input = domNode.querySelector(`.${inputClassName}`);
    this.subjects = domNode.querySelectorAll(`.${subjectClassName}`);
    this.invalidSubjectClassName = invalidSubjectClassName;
    this.cachedSubjectsFilterValues = Array.from(this.subjects).map(subject =>
      subject.dataset.finder.toLowerCase());
    this.debouncedFilter = debounce(() => {
      this.filter(this.input.value);
    }, 500);

    this.bindListeners();
  }

  bindListeners() {
    this.input.addEventListener('input', this.debouncedFilter.bind(this));
  }

  filter(stringToFilter) {
    const stringToFilterWords = stringToFilter.toLowerCase().split(' ');
    Array.from(this.subjects).forEach((subject, index) => {
      const
        subjectFilterValue = this.cachedSubjectsFilterValues[index],
        isSubjectValid = stringToFilterWords.every(word => subjectFilterValue.includes(word));
      if (!isSubjectValid) {
        subject.classList.add(this.invalidSubjectClassName);
      } else {
        subject.classList.remove(this.invalidSubjectClassName);
      }
    });
  }
}

export default Finder;

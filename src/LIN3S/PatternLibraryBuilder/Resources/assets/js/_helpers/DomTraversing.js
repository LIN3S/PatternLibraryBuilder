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

const getDirectDomChildrenByCssClassSelector = (domNode, selector) => {
    return Array.from(domNode.children).filter(childNode => childNode.classList.contains(selector));
  },
  getFirstLevelDomDescendantsByCssClassSelector = (domNode, selector) =>
    getDirectDomChildrenByCssClassSelector(domNode.querySelectorAll(`.${selector}`)[0].parentNode, selector);

export {
  getDirectDomChildrenByCssClassSelector,
  getFirstLevelDomDescendantsByCssClassSelector
};

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

import AccordionItem from './AccordionItem';
import {getFirstLevelDomDescendantsByCssClassSelector} from './../../_helpers/DomTraversing';

class Accordion {

  items = [];

  constructor(domNode, {itemSelector, itemOpenedClass, itemHeaderClassSelector}) {
    const accordionItems = getFirstLevelDomDescendantsByCssClassSelector(domNode, itemSelector);

    accordionItems.forEach(accordionItemNode =>
      this.items.push(new AccordionItem(accordionItemNode, {
        itemOpenedClass,
        itemHeaderClassSelector,
        onItemClickCallback: this.onAccordionItemSelected.bind(this),
        isInitiallyCollapsed: !accordionItemNode.classList.contains(itemOpenedClass)
      }))
    );
  }

  onAccordionItemSelected(anAccordionItem) {
    Array.from(this.items).forEach(accordionItem => {
      if (accordionItem === anAccordionItem) {
        accordionItem.toggle();
      } else {
        accordionItem.close();
      }
    });
  }
}

export default Accordion;

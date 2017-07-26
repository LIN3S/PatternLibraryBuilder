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

import $ from 'jquery';
import AccordionItem from './AccordionItem';

class Accordion {

  items = [];

  constructor(domNode, {itemSelector, itemOpenedClass, itemHeaderClassSelector}) {
    const $accordionItems = $(domNode).find(`.${itemSelector}`).first().parent().children(`.${itemSelector}`);

    Array.from($accordionItems).forEach(accordionItemNode =>
      this.items.push(new AccordionItem(accordionItemNode, {
        itemOpenedClass,
        itemHeaderClassSelector,
        onItemClickCallback: this.onAccordionItemSelected.bind(this),
        isInitiallyCollapsed: !$(accordionItemNode).hasClass(itemOpenedClass)
      }))
    );
  }

  onAccordionItemSelected(anAccordionItem) {
    this.items.forEach(accordionItem => {
      if (accordionItem === anAccordionItem) {
        accordionItem.toggle();
      } else {
        accordionItem.close();
      }
    });
  }
}

export default Accordion;

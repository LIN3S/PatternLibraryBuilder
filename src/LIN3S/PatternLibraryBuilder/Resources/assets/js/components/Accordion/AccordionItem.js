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
import {onWindowResized} from 'lin3s-event-bus';

class AccordionItem {

  $item;
  $itemHeader;
  itemOpenedClass;

  isCollapsed;

  onItemClickCallback;

  constructor(
    domNode,
    {itemOpenedClass, itemHeaderClassSelector, onItemClickCallback = () => {}, isInitiallyCollapsed = true}
  ) {
    this.$item = $(domNode);
    this.$itemHeader = $(domNode).children(`.${itemHeaderClassSelector}`);
    this.itemOpenedClass = itemOpenedClass;
    this.onItemClickCallback = onItemClickCallback;
    this.isCollapsed = isInitiallyCollapsed;

    this.bindListeners();
    this.onResize();
  }

  toggle() {
    if (this.isCollapsed) {
      this.open();
    } else {
      this.close();
    }
  }

  open() {
    this.$item.addClass(this.itemOpenedClass);
    this.isCollapsed = false;
  }

  close() {
    this.$item.removeClass(this.itemOpenedClass);
    this.isCollapsed = true;
  }

  onResize() {
    if (this.isCollapsed) {
      this.close();
    } else {
      this.open();
    }
  }

  bindListeners() {
    this.$itemHeader.on('click', () => {
      this.onItemClickCallback(this);
    });

    onWindowResized(this.onResize.bind(this));
  }
}

export default AccordionItem;

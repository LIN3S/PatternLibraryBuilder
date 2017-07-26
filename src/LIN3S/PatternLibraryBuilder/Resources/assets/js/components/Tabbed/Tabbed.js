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

class Tabbed {

  tabNavItemSelector;
  tabContentSelector;

  $tabs;
  $navItems;

  constructor(domNode, tabNavItemSelector, tabContentSelector) {
    this.tabNavItemSelector = tabNavItemSelector;
    this.tabContentSelector = tabContentSelector;

    const $tabbed = $(domNode);

    this.$navItems = $tabbed.find(`.${this.tabNavItemSelector}`);
    this.$tabs = $tabbed.find(`.${this.tabContentSelector}`);

    this.bindListeners();
  }

  bindListeners() {
    Array.from(this.$navItems).forEach((navItem, index) => {
      $(navItem).on('click', (event) => {
        event.stopPropagation();
        event.preventDefault();

        this.onTabSelected(index);
      });
    });
  }

  onTabSelected(tabIndex) {
    const
      activeNavItemClass = `${this.tabNavItemSelector}--active`,
      activeTabClass = `${this.tabContentSelector}--active`;

    this.$navItems.removeClass(activeNavItemClass);
    this.$navItems.eq(tabIndex).addClass(activeNavItemClass);

    this.$tabs.removeClass(activeTabClass);
    this.$tabs.eq(tabIndex).addClass(activeTabClass);
  }

}

export default Tabbed;

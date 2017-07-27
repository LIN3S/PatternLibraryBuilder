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

class Tabbed {

  tabNavItemSelector;
  tabContentSelector;

  tabs;
  navItems;

  constructor(domNode, tabNavItemSelector, tabContentSelector) {
    this.tabNavItemSelector = tabNavItemSelector;
    this.tabContentSelector = tabContentSelector;

    this.navItems = domNode.querySelectorAll(`.${this.tabNavItemSelector}`);
    this.tabs = domNode.querySelectorAll(`.${this.tabContentSelector}`);

    this.bindListeners();
  }

  bindListeners() {
    this.navItems.forEach((navItem, index) => {
      navItem.addEventListener('click', (event) => {
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

    Array.from(this.navItems).forEach((navItem, index) => {
      if (index === tabIndex) {
        navItem.classList.add(activeNavItemClass);
      } else {
        navItem.classList.remove(activeNavItemClass);
      }
    });

    Array.from(this.tabs).forEach((tab, index) => {
      if (index === tabIndex) {
        tab.classList.add(activeTabClass);
      } else {
        tab.classList.remove(activeTabClass);
      }
    });
  }

}

export default Tabbed;

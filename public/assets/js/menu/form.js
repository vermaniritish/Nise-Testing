var menu = new Vue({
    el: '#menu',
    data: {
        menuItems: [{ id: '', title: '', title_hi: '', link: '', slug: 'header', megaMenu: [] }],
        megaMenu: [{ id: '', title: '',title_hi: '', link: '', slug: 'mega_menu' }],
        megaMenu1: [{ id: '', title: '', title_hi: '', link: '', slug: 'mega_menu1' }],
        megaMenu2: [{ id: '', title: '', title_hi: '', link: '', slug: 'mega_menu2' }],
        megaMenu3: [{ id: '', title: '', title_hi: '', link: '', slug: 'mega_menu3' }],
        megaMenu4: [{ id: '', title: '', title_hi: '', link: '', slug: 'mega_menu4' }],
        footerItems: [{ id: '', title: '', title_hi: '', link: '', slug: 'footer' }],
        coursesItems: [{ id: '', title: '', title_hi: '', link: '', slug: 'courses' }],
        informationItems: [{ id: '', title: '', title_hi: '', link: '', slug: 'information' }],
        otherLinksItems: [{ id: '', title: '', title_hi: '', link: '', slug: 'other_links' }],
        mega_menu_title: ``,
        enable_mega_menu: true,
        mega_menu_title1: ``,
        enable_mega_menu1: true,
        mega_menu_title2: ``,
        enable_mega_menu2: true,
        mega_menu_title3: ``,
        enable_mega_menu3: true,
        mega_menu_title4: ``,
        enable_mega_menu4: true,
        errors: {},
        footerErrors: {},
        loading: false
    },
    mounted() {
        this.fetchMenuItems();
    },
    methods: {
        async fetchMenuItems() {
            try {
                const response = await fetch(admin_url + '/menu/getMenuItems', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
                const data = await response.json();

                if (data.menuItems && Array.isArray(data.menuItems)) {

                    this.menuItems = data.menuItems
                        .filter(item => item.slug === 'header')
                        .map(item => ({
                            id: item.id || '',
                            title: item.key || '',
                            title_hi: item.key_hi || '',
                            link: item.value || '',
                            slug: item.slug || 'header',
                            megaMenu: item.megaMenu
                        }));
                    // console.log('thisxxx console',this.menuItems);

                    this.footerItems = data.menuItems
                        .filter(item => item.slug === 'footer')
                        .map(item => ({
                            id: item.id || '',
                            title: item.key || '',
                            title_hi: item.key_hi || '',
                            link: item.value || '',
                            slug: item.slug || 'footer'
                        }));

                    this.coursesItems = data.menuItems
                        .filter(item => item.slug === 'courses')
                        .map(item => ({
                            id: item.id || '',
                            title: item.key || '',
                            title_hi: item.key_hi || '',
                            link: item.value || '',
                            slug: item.slug || 'courses'
                        }));

                    this.informationItems = data.menuItems
                        .filter(item => item.slug === 'information')
                        .map(item => ({
                            id: item.id || '',
                            title: item.key || '',
                            title_hi: item.key_hi || '',
                            link: item.value || '',
                            slug: item.slug || 'information'
                        }));

                    this.otherLinksItems = data.menuItems
                        .filter(item => item.slug === 'other_links')
                        .map(item => ({
                            id: item.id || '',
                            title: item.key || '',
                            title_hi: item.key_hi || '',
                            link: item.value || '',
                            slug: item.slug || 'other_links'
                        }));
                }
            } catch (error) {
                console.error("Error fetching menu items:", error);
            }
        },
        addItem() {
            this.menuItems.push({ id: '', title: '', title_hi: '', link: '', slug: 'header', megaMenu: [] });
        },

        async removeItem(index) {
            const item = this.menuItems[index];
            if (item.id) {
                if (confirm('Are you sure you want to delete this item?')) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    try {
                        let response = await fetch(admin_url + `/menu/delete/${item.id}`);
                        let data = await response.json();
                        if (data.status) {
                            this.menuItems.splice(index, 1);
                            set_notification('success', 'Record deleted succesfully!');
                        } else {
                            set_notification('error', 'Failed to delete the item!');
                        }
                    } catch (error) {
                        console.error('Error deleting item:', error);
                    }
                }
            } else {
                this.menuItems.splice(index, 1);
            }
        },

        addMegaMenuItem(index) {
            let m = { ...this.menuItems[index] };
            m.megaMenu.push({ title: '',title_hi: '', link: '' })
            this.$set(this.menuItems, index, m);
        },
        removeMegaMenuItem(index, k) {
            let m = { ...this.menuItems[index] };
            m.megaMenu.splice(k, 1);
            this.$set(this.menuItems, index, m);
        },
        addMegaItem(k) {
            if (k == '1')
                this.megaMenu1.push({ id: '', title: '', title_hi: item.key_hi || '', link: '', slug: `mega_menu${k ? k : ``}` });
            else if (k == '2')
                this.megaMenu2.push({ id: '', title: '', title_hi: item.key_hi || '', link: '', slug: `mega_menu${k ? k : ``}` });
            else if (k == '3')
                this.megaMenu3.push({ id: '', title: '', title_hi: item.key_hi || '', link: '', slug: `mega_menu${k ? k : ``}` });
            else if (k == '4')
                this.megaMenu4.push({ id: '', title: '', title_hi: item.key_hi || '', link: '', slug: `mega_menu${k ? k : ``}` });
            else
                this.megaMenu.push({ id: '', title: '', title_hi: item.key_hi || '', link: '', slug: `mega_menu${k ? k : ``}` });

        },
        async removeMegaItem(index, k) {
            const item = null;
            if (k == '1')
                item = this.megaMenu1[index];
            else if (k == '2')
                item = this.megaMenu2[index];
            else if (k == '3')
                item = this.megaMenu3[index];
            else if (k == '4')
                item = this.megaMenu4[index];
            else
                item = this.megaMenu[index];
            if (item.id) {
                if (confirm('Are you sure you want to delete this item?')) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    try {
                        let response = await fetch(admin_url + `/menu/delete/${item.id}`);
                        let data = await response.json();
                        if (data.status) {
                            if (k == '1')
                                this.megaMenu1.splice(index, 1);
                            else if (k == '2')
                                this.megaMenu2.splice(index, 1);
                            else if (k == '3')
                                this.megaMenu3.splice(index, 1);
                            else if (k == '4')
                                this.megaMenu4.splice(index, 1);
                            else
                                this.megaMenu.splice(index, 1);
                            set_notification('success', 'Record deleted succesfully!');
                        } else {
                            set_notification('error', 'Failed to delete the item!');
                        }
                    } catch (error) {
                        console.error('Error deleting item:', error);
                    }
                }
            } else {
                this.megaMenu.splice(index, 1);
            }
        },
        addFooterItem() {
            this.footerItems.push({ id: '', title: '',title_hi: '', link: '', slug: 'footer' });
        },
        async removeFooterItem(index) {
            // this.footerItems.splice(index, 1);
            // return false;
            const item = this.footerItems[index];
            if (item.id) {
                if (confirm('Are you sure you want to delete this footer item?')) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    try {
                        let response = await fetch(admin_url + `/menu/delete/${item.id}`);
                        let data = await response.json();
                        if (data.status) {
                            this.footerItems.splice(index, 1);
                            set_notification('success', 'Record deleted succesfully!');
                        } else {
                            alert(data.message || 'Failed to delete the footer item.');
                        }
                    } catch (error) {
                        console.error('Error deleting footer item:', error);
                    }
                }
            } else {
                this.footerItems.splice(index, 1);
            }
        },
        async submitForm()
        {
            if (this.loading) {
                return;
            }
            this.loading = true;

            console.log({ test: this.loading })
            const formData = {
                menuItems: this.menuItems
            };
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let response;
            try {

                    response = await fetch(admin_url + '/header/menu/add', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(formData)
                    });

                let data = await response.json();
                if (data.status) {
                    this.errors = {};
                    this.loading = false;

                    set_notification('success', 'Header menu saved succesfully!');
                    this.fetchMenuItems();
                } else {
                    this.errors = data.errors || [];
                    this.loading = false;

                    set_notification('error', data.message);
                    console.log('errr is', this.errors);
                }
            } catch (error) {
                this.loading = false;
                console.error("Error submitting form:", error);
            } finally {
                setTimeout(() => {
                    this.loading = false;
                }, 5000);
            }

        },
        async submitMegaForm(k) {
            let formData = null;
            if (k == '1')
                formData = {
                    menuItems: [
                        ...this.megaMenu1.map(item => ({
                            id: item.id || null,
                            title: item.title,
                            title_hi: item.title_hi,
                            link: item.link,
                            slug: item.slug
                        }))
                    ],
                    enable_mega_menu1: this.enable_mega_menu1 ? 1 : 0,
                    mega_menu_title1: this.mega_menu_title1
                };
            else if (k == '2')
                formData = {
                    menuItems: [
                        ...this.megaMenu2.map(item => ({
                            id: item.id || null,
                            title: item.title,
                            title_hi: item.title_hi,
                            link: item.link,
                            slug: item.slug
                        }))
                    ],
                    enable_mega_menu2: this.enable_mega_menu2 ? 1 : 0,
                    mega_menu_title2: this.mega_menu_title2
                };
            else if (k == '3')
                formData = {
                    menuItems: [
                        ...this.megaMenu3.map(item => ({
                            id: item.id || null,
                            title: item.title,
                            title_hi: item.title_hi,
                            link: item.link,
                            slug: item.slug
                        }))
                    ],
                    enable_mega_menu3: this.enable_mega_menu3 ? 1 : 0,
                    mega_menu_title3: this.mega_menu_title3
                };
            else if (k == '4')
                formData = {
                    menuItems: [
                        ...this.megaMenu4.map(item => ({
                            id: item.id || null,
                            title: item.title,
                            title_hi: item.title_hi,
                            link: item.link,
                            slug: item.slug
                        }))
                    ],
                    enable_mega_menu4: this.enable_mega_menu4 ? 1 : 0,
                    mega_menu_title4: this.mega_menu_title4
                };
            else
                formData = {
                    menuItems: [
                        ...this.megaMenu.map(item => ({
                            id: item.id || null,
                            title: item.title,
                            title_hi: item.title_hi,
                            link: item.link,
                            slug: item.slug
                        }))
                    ],
                    enable_mega_menu: this.enable_mega_menu ? 1 : 0,
                    mega_menu_title: this.mega_menu_title
                };
            console.log('header clicked', formData.menuItems);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try {
                let response = await fetch(admin_url + '/header/menu/add', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                let data = await response.json();
                if (data.status) {
                    this.errors = {};
                    set_notification('success', 'Header menu saved succesfully!');
                    this.fetchMenuItems();
                } else {
                    this.errors = data.errors || [];
                    set_notification('error', data.message);
                    console.log('errr is', this.errors);
                }
            } catch (error) {
                console.error("Error submitting form:", error);
            }
        },
        async submitFooterForm() {
            const formData = {
                footerItems: [
                    ...this.footerItems.map(item => ({
                        id: item.id || null,
                        title: item.title,
                        title_hi: item.title_hi,
                        title_hi: item.title_hi,
                        link: item.link,
                        slug: item.slug
                    }))
                ]
            };
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try {
                let response = await fetch(admin_url + '/footer-menu/add', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                let data = await response.json();
                if (data.status) {
                    this.footerErrors = {};
                    set_notification('success', 'Footer menu saved succesfully!');
                    this.fetchMenuItems();
                } else {
                    this.footerErrors = data.errors || {};
                }
            } catch (error) {
                console.error("Error submitting footer form:", error);
            }
        },
        //Courses Functions
        addCourseItem() {
            this.coursesItems.push({ id: '', title: '',title_hi: '', link: '', slug: 'courses' });
        },
        async removeCourseItem(index) {
            const item = this.coursesItems[index];
            if (item.id) {
                if (confirm('Are you sure you want to delete this menu item?')) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    try {
                        let response = await fetch(admin_url + `/menu/delete/${item.id}`);
                        let data = await response.json();
                        if (data.status) {
                            this.coursesItems.splice(index, 1);
                            set_notification('success', 'Record deleted succesfully!');
                        } else {
                            alert(data.message || 'Failed to delete the footer item.');
                        }
                    } catch (error) {
                        console.error('Error deleting footer item:', error);
                    }
                }
            } else {
                this.coursesItems.splice(index, 1);
            }
        },
        async submitCoursesForm() {
            const formData = {
                coursesItems: [
                    ...this.coursesItems.map(item => ({
                        id: item.id || null,
                        title: item.title,
                        title_hi: item.title_hi,
                        link: item.link,
                        slug: item.slug
                    }))
                ]
            };
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try {
                let response = await fetch(admin_url + '/courses-menu/add', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                let data = await response.json();
                if (data.status) {
                    set_notification('success', 'Courses menu saved succesfully!');
                    this.fetchMenuItems();
                } else {
                }
            } catch (error) {
                console.error("Error submitting courses form:", error);
            }
        },

        addInformationItem() {
            this.informationItems.push({ id: '', title: '',title_hi: '', link: '', slug: 'information' });
        },
        async removeInformationItem(index) {
          const item = this.informationItems[index];
          if (item.id) {
            if (confirm('Are you sure you want to delete this menu item?')) {
              try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch(`${admin_url}/menu/delete/${item.id}`);
                const data = await response.json();
                if (data.status) {
                  this.$nextTick(() => {
                    this.informationItems.splice(index, 1);
                  });
                  set_notification('success', 'Record deleted successfully!');
                } else {
                  alert(data.message || 'Failed to delete the footer item.');
                }
              } catch (error) {
                console.error('Error deleting footer item:', error);
              }
            }
          } else {
            this.$nextTick(() => {
              this.informationItems.splice(index, 1);
            });
          }
        },
        async submitInformationForm() {
            const formData = {
                informationItems: [
                    ...this.informationItems.map(item => ({
                        id: item.id || null,
                        title: item.title,
                        title_hi: item.title_hi,
                        link: item.link,
                        slug: item.slug
                    }))
                ]
            };
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try {
                let response = await fetch(admin_url + '/information-menu/add', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                let data = await response.json();
                if (data.status) {
                    set_notification('success', 'Courses menu saved succesfully!');
                    this.fetchMenuItems();
                } else {
                }
            } catch (error) {
                console.error("Error submitting courses form:", error);
            }
        },

        addOtherLinksItem() {
            this.otherLinksItems.push({ id: '', title: '',title_hi: '', link: '', slug: 'other_links' });
        },
        async removeOtherLinksItem(index) {
          const item = this.otherLinksItems[index];
          if (item.id) {
            if (confirm('Are you sure you want to delete this menu item?')) {
              try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch(`${admin_url}/menu/delete/${item.id}`);
                const data = await response.json();
                if (data.status) {
                  this.$nextTick(() => {
                    this.otherLinksItems.splice(index, 1);
                  });
                  set_notification('success', 'Record deleted successfully!');
                } else {
                  alert(data.message || 'Failed to delete the footer item.');
                }
              } catch (error) {
                console.error('Error deleting footer item:', error);
              }
            }
          } else {
            this.$nextTick(() => {
              this.otherLinksItems.splice(index, 1);
            });
          }
        },
        async submitOtherLinksForm() {
            const formData = {
                otherLinksItems: [
                    ...this.otherLinksItems.map(item => ({
                        id: item.id || null,
                        title: item.title,
                        title_hi: item.title_hi,
                        link: item.link,
                        slug: item.slug
                    }))
                ]
            };
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try {
                let response = await fetch(admin_url + '/other-links-menu/add', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                let data = await response.json();
                if (data.status) {
                    set_notification('success', 'Other links menu saved succesfully!');
                    this.fetchMenuItems();
                } else {
                }
            } catch (error) {
                console.error("Error submitting courses form:", error);
            }
        },
    }
});

<?php

namespace Drupal\Tests\blog\Functional;

/**
 * "My blog" link test for blog module.
 *
 * @group blog
 */
class MyBlogLinkTest extends BlogTestBase {

  protected static $modules = [
    'block',
    'blog',
  ];

  /**
   * @var \Drupal\user\UserInterface
   */
  protected $regular_user;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    // Create regular user.
    $this->regular_user = $this->drupalCreateUser(['create article content']);
    // add account_menu block
    $this->placeBlock('system_menu_block:account', ['region' => 'content']);
  }

  /**
   * Test "My blog" link with blogger user.
   */
  public function testMyBlogLinkWithBloggerUser() {
    $this->drupalLogin($this->blogger1);
    $this->assertLink('My blog');
    $this->assertLinkByHref('/blog/' . $this->blogger1->id());
  }

  /**
   * Test "My blog" link with regular user.
   */
  public function testMyBlogLinkWithRegularUser() {
    $this->assertNoLink('My blog');
  }

  /**
   * Test "My blog" link with anonymous user.
   */
  public function testMyBlogLinkWithAnonUser() {
    $this->assertNoLink('My blog');
  }

}

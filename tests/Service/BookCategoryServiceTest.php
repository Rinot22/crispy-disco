<?php

namespace App\Tests\Service;

use App\Entity\BookCategory;
use App\Model\BookCategoryListItem;
use App\Model\BookCategoryListResponse;
use App\Repository\BookCategoryRepository;
use App\Service\BookCategoryService;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;

class BookCategoryServiceTest extends TestCase
{
    public function testGetCategories()
    {
        $repo = $this->createMock(BookCategoryRepository::class);
        $repo->expects($this->once())
            ->method('findBy')
            ->with([], ['title' => Criteria::ASC])
            ->willReturn([(new BookCategory())->setId(7)->setTitle('Test')->setSlug('test')]);

        $service = new BookCategoryService($repo);
        $expected = new BookCategoryListResponse([new BookCategoryListItem(7, 'Test', 'test')]);

        $this->assertEquals($expected, $service->getCategories());
    }
}

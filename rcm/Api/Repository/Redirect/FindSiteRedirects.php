<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Redirect;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Redirect;
use Rcm\Api\Repository\Options;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindSiteRedirects extends \Rcm\Api\Repository\Redirect\FindSiteRedirects
{
    const OPTION_ORDER_BY = 'orderBy';
    const OPTION_LIMIT = 'limit';
    const OPTION_OFFSET = 'offset';

    /**
     * @var \Rcm\Repository\Redirect
     */
    protected $repository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(
        EntityManager $entityManager
    ) {
        $this->repository = $entityManager->getRepository(
            Redirect::class
        );
    }

    /**
     * @param int   $siteId
     * @param array $options
     *
     * @return Redirect[]
     */
    public function __invoke(
        int $siteId,
        array $options = []
    ) {
        $orderBy = Options::get($options, self::OPTION_ORDER_BY, null);
        $limit = Options::get($options, self::OPTION_LIMIT, null);
        $offset = Options::get($options, self::OPTION_OFFSET, null);

        return $this->repository->findBy(
            ['siteId' => $siteId],
            $orderBy,
            $limit,
            $offset
        );
    }
}

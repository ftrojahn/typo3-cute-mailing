<?php

namespace Undkonsorten\CuteMailing\Domain\Model;

use FriendsOfTYPO3\TtAddress\Domain\Repository\AddressRepository;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

class TtAddressRecipientList  extends AbstractRecipientList
{
    /**
     * @var int
     */
    protected $recipientListPage;


    /**
     * @return int
     */
    public function getRecipientListPage(): int
    {
        return $this->recipientListPage;
    }

    /**
     * @param int $recipientListPage
     */
    public function setRecipientListPage(int $recipientListPage): void
    {
        $this->recipientListPage = $recipientListPage;
    }


    public function getRecipients(): array
    {
        $result = [];
        if(ExtensionManagementUtility::isLoaded('tt_address')){
            /**@var $addressRepository AddressRepository **/
            $addressRepository = GeneralUtility::makeInstance(AddressRepository::class);
            /**@var $defaultQuerySettings Typo3QuerySettings**/
            $defaultQuerySettings = $this->defaultQuerySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
            $defaultQuerySettings->setRespectStoragePage(true);
            $defaultQuerySettings->setStoragePageIds([$this->getRecipientListPage()]);
            $addressRepository->setDefaultQuerySettings($defaultQuerySettings);
            $result = $addressRepository->findAll()->toArray();
        }
        return $result;
    }
}

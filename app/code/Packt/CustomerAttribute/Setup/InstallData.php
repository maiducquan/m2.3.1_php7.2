<?php

namespace Packt\CustomerAttribute\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $customerSetupFactory;

    public function __construct(
        \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
    ){
        $this->customerSetupFactory = $customerSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup,
                            ModuleContextInterface $context)
    {
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $setup->startSetup();
        $customerSetup->addAttribute('customer', 'loyaltynumber', [
            'label' => 'Loyaltynumber',
            'type' => 'varchar',
            'input' => 'text',
            'required' => false,
            'visible' => true,
            'position' => 105,
            'system' => false
        ]);
        $loyaltyAttribute = $customerSetup->getEavConfig()->getAttribute('customer', 'loyaltynumber');
        $loyaltyAttribute->setData('used_in_forms', ['adminhtml_customer','customer_account_create','customer_account_edit']);
        $loyaltyAttribute->save();
        $setup->endSetup();
    }
}
<?php

use Doctrine\ODM\MongoDB\Types\Type;
use Payum\Core\Bridge\Doctrine\Types\ObjectType;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function boot()
    {
        if (false == Type::hasType('object')) {
            Type::addType('object', ObjectType::class);
        }

        parent::boot();
    }

    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\MongoDBBundle\DoctrineMongoDBBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\Payment\CoreBundle\JMSPaymentCoreBundle(),
            new JMS\Payment\PaypalBundle\JMSPaymentPaypalBundle(),

            new Payum\Bundle\PayumBundle\PayumBundle(),

            new Acme\DemoBundle\AcmeDemoBundle(),
            new Acme\PaymentBundle\AcmePaymentBundle(),
            new Acme\PaypalExpressCheckoutBundle\AcmePaypalExpressCheckoutBundle(),
            new Acme\StripeBundle\AcmeStripeBundle(),
            new Acme\RedsysBundle\AcmeRedsysBundle(),
            new Acme\PayexBundle\AcmePayexBundle(),
            new Acme\KlarnaBundle\AcmeKlarnaBundle(),
            new Acme\OtherExamplesBundle\AcmeOtherExamplesBundle(),

            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $config = __DIR__.'/config/config_'.$this->getEnvironment().'.yml';
        if (file_exists(__DIR__.'/config/config_'.$this->getEnvironment().'_local.yml')) {
            $config = __DIR__.'/config/config_'.$this->getEnvironment().'_local.yml';
        }
        $loader->load($config);
    }
}

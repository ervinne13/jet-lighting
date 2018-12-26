<?php

namespace DoctrineProxies\__CG__\Jet\Domain\PLD\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class SupplierCost extends \Jet\Domain\PLD\Entity\SupplierCost implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Jet\\Domain\\PLD\\Entity\\SupplierCost' . "\0" . 'supplier', '' . "\0" . 'Jet\\Domain\\PLD\\Entity\\SupplierCost' . "\0" . 'item', '' . "\0" . 'Jet\\Domain\\PLD\\Entity\\SupplierCost' . "\0" . 'lastPurchasedUnitCost', 'createdAt', 'updatedAt'];
        }

        return ['__isInitialized__', '' . "\0" . 'Jet\\Domain\\PLD\\Entity\\SupplierCost' . "\0" . 'supplier', '' . "\0" . 'Jet\\Domain\\PLD\\Entity\\SupplierCost' . "\0" . 'item', '' . "\0" . 'Jet\\Domain\\PLD\\Entity\\SupplierCost' . "\0" . 'lastPurchasedUnitCost', 'createdAt', 'updatedAt'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (SupplierCost $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getItem(): \Jet\Domain\PLD\Entity\Item
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getItem', []);

        return parent::getItem();
    }

    /**
     * {@inheritDoc}
     */
    public function setItem(\Jet\Domain\PLD\Entity\Item $item)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setItem', [$item]);

        return parent::setItem($item);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastPurchasedUnitCost(): float
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastPurchasedUnitCost', []);

        return parent::getLastPurchasedUnitCost();
    }

    /**
     * {@inheritDoc}
     */
    public function getCost(): float
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCost', []);

        return parent::getCost();
    }

    /**
     * {@inheritDoc}
     */
    public function getSupplier(): \Jet\Domain\PLD\Entity\Supplier
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSupplier', []);

        return parent::getSupplier();
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'jsonSerialize', []);

        return parent::jsonSerialize();
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAt', []);

        return parent::getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedAt', []);

        return parent::getUpdatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedAt', [$createdAt]);

        return parent::setCreatedAt($createdAt);
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedAt', [$updatedAt]);

        return parent::setUpdatedAt($updatedAt);
    }

}

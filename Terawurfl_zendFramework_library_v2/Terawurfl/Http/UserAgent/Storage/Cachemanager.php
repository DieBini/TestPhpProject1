<?php
/**
 * Terawurfl
 * @package ZendTerawurfl
 * @subpackage Terawurfl_Http_UserAgent_Storage
 * @version 1.0
 * @author sabine steinkamp
 */
class Terawurfl_Http_UserAgent_Storage_Cachemanager implements Zend_Http_UserAgent_Storage {
    

    const exc_nocache = 'Cache "%s" not found in manager';
    const default_prefix = 'uastring-';
    
    /**
     * @var string
     */
    protected $cacheId;
    /**
     * @var Zend_Cache_Backend_Interface
     */
    protected $cache;

    /**
     * @param array|Zend_Array|ArrayObject|stdObject $options
     * @throws Zend_Http_UserAgent_Storage_Exception Not found "name" parameter
     * @throws Zend_Http_UserAgent_Storage_Exception Cache not found
     */
    public function __construct($options = null) {
        
        // get oprions as array:
        if (is_object($options)) {
            if (method_exists($options, 'toArray')) {
                $options = $options->toArray();
            } else {
                $options = (array) $options;
            }
        }
        
        // get cache name:
        if (isset($options['cachename'])) {
            $name = $options['cachename'];
        } else {
            throw new Zend_Http_UserAgent_Storage_Exception("Missing 'cachename' param in config options");
        }
        
        // set prefix:
        if (isset($options['prefix'])) {
            $prefix = $options['prefix'];
        } else {
            $prefix = self::default_prefix;
        }
        
        // create cache id:
        $this->cacheId = $this->createId($prefix, $options['browser_type']);
        // get cache:
        $this->getCache($name);
        
    }

    /**
     * Get CacheManager from Resource and get cache
     * @param string $name
     * @throws Zend_Http_UserAgent_Storage_Exception
     */
    protected function getCache($name) {

        /* @var $cacheManager Zend_Cache_Manager */
        $cacheManager = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('cachemanager');
        if ($cacheManager->hasCache($name)) {
            $this->cache = $cacheManager->getCache($name)->getBackend();
        } else {
            throw new Zend_Http_UserAgent_Storage_Exception(sprintf(self::exc_nocache, $name));
        }
    }
    
    /**
     * Generate Cache id
     * @param string $prefix
     * @param string $userAgent
     * @return string
     */
    protected function createId($prefix, $userAgent) {
        return $prefix . md5($userAgent);
    }

    /**
     * Remove useragent data
     */
    public function clear() {
        $this->cache->remove($this->cacheId);
    }

    /**
     * Check wether empty
     * @return bool
     */
    public function isEmpty() {
        return !(bool) $this->cache->test($this->cacheId);
    }

    /**
     * Read from Cache
     * @return mixed
     */
    public function read() {
        return $this->cache->load($this->cacheId);
    }

    /**
     * Write to Cache
     * @param mixed $contents
     */
    public function write($contents) {
        $this->cache->save($contents, $this->cacheId);
    }
}
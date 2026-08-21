<?php
// app/Libraries/AGApiRouter.php

namespace App\Libraries;

class AGApiRouter
{
    private $baseUrl;
    private $headers;
    private $timeout;
    private $apiMapping;
    
    public function __construct()
    {
        $this->baseUrl = "http://46.202.195.173/api/v1";
        $this->headers = [
            "Host: api.agfoundationdb.org",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36",
            "Accept: application/json"
        ];
        $this->timeout = 30;
        
        $this->apiMapping = $this->getApiMapping();
    }
    
    private function getApiMapping()
    {
        return [
            'stats' => [
                'endpoint' => '/stats',
                'patterns' => ['how many', 'count of', 'total', 'statistics', 'summary', 'overview', 'system stats', 'database stats'],
                'description' => 'Get system statistics'
            ],
            'active_farmers' => [
                'endpoint' => '/farmers/active',
                'patterns' => ['active farmers', 'list active farmers', 'farmers active', 'active farmer list'],
                'params' => ['limit' => 50, 'offset' => 0],
                'description' => 'Get active farmers'
            ],
            'farmers_by_county' => [
                'endpoint' => '/farmers/by-county/{county}',
                'patterns' => ['farmers in', 'farmers from', 'farmers of', 'farmers by county'],
                'params' => ['limit' => 100],
                'description' => 'Get farmers by county'
            ],
            'search_farmers' => [
                'endpoint' => '/farmers/search-by-name/{name}',
                'patterns' => ['find farmer', 'search farmer', 'farmer named', 'who is farmer', 'tell me about farmer', 'farmer called'],
                'params' => ['limit' => 50],
                'description' => 'Search farmers by name'
            ],
            'farmer_stats' => [
                'endpoint' => '/farmers/statistics/aggregated',
                'patterns' => ['farmer statistics', 'farmer stats', 'farmer distribution', 'farmer demographics', 'farmers summary'],
                'description' => 'Get farmer statistics'
            ],
            'groups' => [
                'endpoint' => '/groups',
                'patterns' => ['list groups', 'all groups', 'groups in', 'cooperatives', 'show groups', 'get groups'],
                'params' => ['limit' => 50, 'offset' => 0],
                'description' => 'Get list of groups'
            ],
            'group_stats' => [
                'endpoint' => '/groups/comprehensive-stats',
                'patterns' => ['group statistics', 'group stats', 'groups summary', 'cooperative stats', 'how many groups'],
                'description' => 'Get group statistics'
            ],
            'businesses' => [
                'endpoint' => '/businesses',
                'patterns' => ['list businesses', 'all businesses', 'agribusinesses', 'businesses in', 'show businesses', 'get businesses'],
                'params' => ['limit' => 50, 'offset' => 0],
                'description' => 'Get list of businesses'
            ],
            'business_stats' => [
                'endpoint' => '/businesses/stats',
                'patterns' => ['business statistics', 'business stats', 'agribusiness stats', 'how many businesses'],
                'description' => 'Get business statistics'
            ],
            'commodities' => [
                'endpoint' => '/commodities',
                'patterns' => ['list commodities', 'all commodities', 'commodities available', 'what commodities', 'show commodities', 'get commodities'],
                'description' => 'Get list of commodities'
            ],
            'programs' => [
                'endpoint' => '/programs',
                'patterns' => ['list programs', 'all programs', 'programs available', 'programs in', 'show programs', 'get programs'],
                'params' => ['limit' => 50, 'offset' => 0],
                'description' => 'Get list of programs'
            ],
            'program_stats' => [
                'endpoint' => '/programs/stats',
                'patterns' => ['program statistics', 'program stats', 'programs summary', 'how many programs'],
                'description' => 'Get program statistics'
            ],
            'counties' => [
                'endpoint' => '/counties',
                'patterns' => ['list counties', 'all counties', 'counties in liberia', 'show counties'],
                'description' => 'Get list of counties'
            ],
            'trading_farmers' => [
                'endpoint' => '/trading-farmers',
                'patterns' => ['trading farmers', 'eligible farmers', 'farmers eligible for trading', 'trading eligible'],
                'params' => ['limit' => 50, 'offset' => 0],
                'description' => 'Get trading-eligible farmers'
            ],
            'analytics' => [
                'endpoint' => '/analytics',
                'patterns' => ['analytics', 'analysis', 'trends', 'insights', 'data analysis'],
                'description' => 'Get analytics data'
            ]
        ];
    }
    
    public function matchEndpoint($question)
    {
        $questionLower = strtolower($question);
        
        // Check for search patterns first
        $searchPatterns = ['find', 'search', 'who is', 'tell me about', 'farmer named', 'farmer called'];
        foreach ($searchPatterns as $pattern) {
            if (strpos($questionLower, $pattern) !== false) {
                return 'search_farmers';
            }
        }
        
        // Check for county patterns
        $countyPatterns = ['farmers in', 'farmers from', 'farmers of', 'farmers by county'];
        foreach ($countyPatterns as $pattern) {
            if (strpos($questionLower, $pattern) !== false) {
                return 'farmers_by_county';
            }
        }
        
        // Check for active farmers
        if (strpos($questionLower, 'active farmers') !== false) {
            return 'active_farmers';
        }
        
        // Check for statistics
        $statsPatterns = ['how many', 'count', 'total', 'statistics', 'stats'];
        foreach ($statsPatterns as $pattern) {
            if (strpos($questionLower, $pattern) !== false) {
                if (strpos($questionLower, 'farmer') !== false) {
                    return 'farmer_stats';
                } elseif (strpos($questionLower, 'group') !== false) {
                    return 'group_stats';
                } elseif (strpos($questionLower, 'business') !== false) {
                    return 'business_stats';
                } elseif (strpos($questionLower, 'program') !== false) {
                    return 'program_stats';
                } else {
                    return 'stats';
                }
            }
        }
        
        // Check for entity types
        if (strpos($questionLower, 'farmer') !== false || strpos($questionLower, 'farmers') !== false) {
            return 'active_farmers';
        } elseif (strpos($questionLower, 'group') !== false || strpos($questionLower, 'groups') !== false) {
            return 'groups';
        } elseif (strpos($questionLower, 'business') !== false || strpos($questionLower, 'businesses') !== false) {
            return 'businesses';
        } elseif (strpos($questionLower, 'commodity') !== false || strpos($questionLower, 'commodities') !== false) {
            return 'commodities';
        } elseif (strpos($questionLower, 'program') !== false || strpos($questionLower, 'programs') !== false) {
            return 'programs';
        } elseif (strpos($questionLower, 'county') !== false || strpos($questionLower, 'counties') !== false) {
            return 'counties';
        } elseif (strpos($questionLower, 'trading') !== false) {
            return 'trading_farmers';
        }
        
        return null;
    }
    
    public function extractParams($question, $endpointKey)
    {
        $params = [];
        
        // Extract name for search
        if ($endpointKey === 'search_farmers') {
            // Pattern: "tell me about farmer John Doe"
            if (preg_match('/(?:farmer|find|search|about|called|named)\s+([a-zA-Z\s\-\.]+?)(?:\?|\.|$|,| and)/i', $question, $matches)) {
                $name = trim($matches[1]);
                if (!empty($name) && strlen($name) > 1 && !in_array(strtolower($name), ['farmer', 'farmers', 'a', 'an', 'the'])) {
                    $params['name'] = $name;
                    return $params;
                }
            }
            
            // Pattern: "who is John Doe"
            if (preg_match('/who\s+is\s+([a-zA-Z\s\-\.]+?)(?:\?|\.|$)/i', $question, $matches)) {
                $name = trim($matches[1]);
                if (!empty($name) && strlen($name) > 1 && !in_array(strtolower($name), ['farmer', 'farmers', 'a', 'an', 'the'])) {
                    $params['name'] = $name;
                    return $params;
                }
            }
        }
        
        // Extract county
        if ($endpointKey === 'farmers_by_county') {
            // Pattern: "farmers in Montserrado"
            if (preg_match('/(?:in|from|of|county)\s+([a-zA-Z\s\-]+?)(?:\?|\.|$|,| and)/i', $question, $matches)) {
                $county = trim($matches[1]);
                if (!empty($county) && strlen($county) > 1 && !in_array(strtolower($county), ['county', 'counties', 'a', 'an', 'the'])) {
                    $params['county'] = $county;
                    return $params;
                }
            }
        }
        
        return $params;
    }
    
    public function callApi($endpointKey, $params = [])
    {
        if (!isset($this->apiMapping[$endpointKey])) {
            return [null, "No API endpoint found for: {$endpointKey}"];
        }
        
        $config = $this->apiMapping[$endpointKey];
        $endpointTemplate = $config['endpoint'];
        
        // Build URL
        $url = $this->baseUrl . $endpointTemplate;
        
        // Replace path parameters
        foreach ($params as $key => $value) {
            if (strpos($endpointTemplate, "{{$key}}") !== false) {
                $url = str_replace("{{$key}}", urlencode($value), $url);
                unset($params[$key]);
            }
        }
        
        // Build query parameters
        $queryParams = $config['params'] ?? [];
        foreach ($params as $key => $value) {
            if (strpos($endpointTemplate, "{{$key}}") === false) {
                $queryParams[$key] = $value;
            }
        }
        
        // Build full URL with query string
        if (!empty($queryParams)) {
            $url .= '?' . http_build_query($queryParams);
        }
        
        // Make request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_error($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return [null, "API call failed: {$error}"];
        }
        
        curl_close($ch);
        
        if ($httpCode === 200) {
            $data = json_decode($response, true);
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                return [null, "Invalid JSON response"];
            }
            return [$data, null];
        } else {
            return [null, "API error {$httpCode}: " . substr($response, 0, 100)];
        }
    }
    
    public function formatResponse($data, $question)
    {
        if (empty($data)) {
            return "I couldn't retrieve data for that question.";
        }
        
        // Check for API error responses
        if (isset($data['status']) && $data['status'] === 'error') {
            return "Error: " . ($data['message'] ?? 'Unknown error');
        }
        
        // Handle different response structures
        if (isset($data['data']) && is_array($data['data'])) {
            $items = $data['data'];
            $total = $data['total'] ?? count($items);
            
            if (empty($items)) {
                return "No results found." . ($total > 0 ? " (Total available: {$total})" : "");
            }
            
            // Format list of items
            $formattedItems = [];
            $displayLimit = min(10, count($items));
            
            for ($i = 0; $i < $displayLimit; $i++) {
                $item = $items[$i];
                if (is_array($item)) {
                    $name = $item['full_name'] ?? 
                           trim(($item['first_name'] ?? '') . ' ' . ($item['last_name'] ?? '')) ??
                           $item['business_name'] ?? 
                           $item['name'] ?? 
                           $item['program_project_name'] ?? 
                           'Unknown';
                    
                    $status = $item['verification_status'] ?? $item['status'] ?? '';
                    $county = $item['primary_county_name'] ?? $item['county_name'] ?? '';
                    
                    if (!empty($status) && !empty($county)) {
                        $formattedItems[] = "{$name} ({$status}, {$county})";
                    } elseif (!empty($status)) {
                        $formattedItems[] = "{$name} ({$status})";
                    } else {
                        $formattedItems[] = (string)$name;
                    }
                } else {
                    $formattedItems[] = (string)$item;
                }
            }
            
            if ($total > $displayLimit) {
                return "Found {$total} items: " . implode(', ', $formattedItems) . "... (showing first {$displayLimit})";
            } else {
                return "Found {$total} items: " . implode(', ', $formattedItems);
            }
        }
        
        // Handle stats
        if (isset($data['stats']) && is_array($data['stats'])) {
            $stats = $data['stats'];
            $lines = [];
            foreach ($stats as $key => $value) {
                $keyDisplay = str_replace('_', ' ', ucwords($key));
                if (is_numeric($value)) {
                    $lines[] = "{$keyDisplay}: " . number_format($value);
                } else {
                    $lines[] = "{$keyDisplay}: {$value}";
                }
            }
            return implode("\n", array_slice($lines, 0, 10));
        }
        
        // Handle single item
        if (isset($data['full_name']) || isset($data['first_name'])) {
            $name = $data['full_name'] ?? trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));
            $status = $data['verification_status'] ?? 'Unknown';
            $county = $data['primary_county_name'] ?? $data['county_name'] ?? 'Liberia';
            $phone = $data['phone'] ?? 'Not available';
            return "{$name} is a farmer from {$county}. Status: {$status}. Phone: {$phone}.";
        }
        
        // Fallback
        return substr(json_encode($data), 0, 500);
    }
    
    public function query($question)
    {
        // Match endpoint
        $endpointKey = $this->matchEndpoint($question);
        
        if (!$endpointKey) {
            return null;
        }
        
        // Extract parameters
        $params = $this->extractParams($question, $endpointKey);
        
        // Call API
        list($data, $error) = $this->callApi($endpointKey, $params);
        
        if ($error) {
            return null;
        }
        
        return $this->formatResponse($data, $question);
    }
    
    public function getApiInfo()
    {
        $info = [];
        foreach ($this->apiMapping as $key => $config) {
            $info[] = "  - {$key}: " . ($config['description'] ?? 'No description');
        }
        return implode("\n", $info);
    }
    
    public function testConnection()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . '/stats');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return $httpCode === 200;
    }
}